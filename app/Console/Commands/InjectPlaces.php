<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Str;

class InjectPlaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inject:places';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this commands to inject data from google apis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $folderPath = storage_path('app/public/pariwisata_data/*.json');
        try {
            DB::beginTransaction();
            foreach (glob($folderPath) as $filepath) {
                $filename = basename($filepath);
                $data = \json_decode(\file_get_contents($filepath),true);
                $wilayah = \App\Models\Wilayah::firstOrCreate([
                    "name"=>$filename
                ]);
                foreach ($data["results"] as $key => $value) {
                    $photos = [];
                    $arr_photo = $value["photos"] ?? [];
                    foreach($arr_photo as $photo){
                        $photo_link = "https://maps.googleapis.com/maps/api/place/photo?maxwidth={$photo["width"]}&photo_reference={$photo["photo_reference"]}&key=AIzaSyBDpoXg_iNv-dAAXEM1mek_sSKqLijSNOI";
                        $photo_name = Str::random(8);
                        $public_access = "/foto_google/{$filename}-{$photo_name}.jpg";
                        $save = storage_path("app/public".$public_access);
                        copy($photo_link,$save);
                        $photos[] = "/storage/".$public_access;
                    }
                    $places = \App\Models\Place::create([
                        'name'=>$value["name"],
                        'rating'=>$value["rating"] ?? 0,
                        'photos'=>json_encode($photos),
                        'google_places_api'=>json_encode($value),
                        "wilayah_id"=>$wilayah->id
                    ]);
                    $query = "UPDATE `places` SET ".
                    "location = ST_GeomFromText('POINT(".$value["geometry"]["location"]["lat"]." ".$value["geometry"]["location"]["lng"].")',0)".
                    " WHERE id = ".$places->id;
                    DB::unprepared($query);
                }
            }
            DB::commit();
            echo "OK";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
    }
}
