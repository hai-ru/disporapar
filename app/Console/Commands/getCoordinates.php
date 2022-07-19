<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Str;

class getCoordinates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inject:coordinate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = \App\Models\Place::where("active",1)
        ->where("location",null)
        ->get();
        $total = count($data);
        echo "Total : ".$total;
        $failed = [];
        foreach ($data as $key => $value) {
            // $location_name = urlencode($value["name"]);
            // $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=business_status,formatted_address,geometry,icon,icon_mask_base_uri,icon_background_color,name,photo,place_id,plus_code,type&input={$location_name}&inputtype=textquery&key=AIzaSyBDpoXg_iNv-dAAXEM1mek_sSKqLijSNOI";
            // $data = file_get_contents($url);
            // $value->google_places_api = json_decode($data,true);
            // $value->save();
            // $count = $key+1;
            $geos = $value["google_places_api"];
            if($geos["status"] !== "OK"){
                $failed[] = $value;
                continue;
            } 
            foreach($geos["candidates"] as $k => $val){
                if(!Str::contains($val["formatted_address"], 'Kalimantan')) continue;
                $geo = $val;
                $query = "UPDATE `places` SET ".
                "location = ST_GeomFromText('POINT(".$geo["geometry"]["location"]["lat"]." ".$geo["geometry"]["location"]["lng"].")',0)".
                " WHERE id = ".$value->id;
                DB::unprepared($query);
                $photos = [];
                $arr_photo = $val["photos"] ?? [];
                foreach($arr_photo as $photo){
                    $public_access = "/foto_google/{$value["slug"]}.jpg";
                    $save = storage_path("app/public".$public_access);
                    if(file_exists($save)) continue;
                    $photo_link = "https://maps.googleapis.com/maps/api/place/photo?maxwidth={$photo["width"]}&photo_reference={$photo["photo_reference"]}&key=AIzaSyBDpoXg_iNv-dAAXEM1mek_sSKqLijSNOI";
                    copy($photo_link,$save);
                    $photos[] = "/storage/".$public_access;
                }
                $value->photos =  $photos;
                $value->save();
            }
            $count = $key+1;
            echo "\nplaces {$count}/{$total}";
        }
        echo "\nOK";
    }

    
}
