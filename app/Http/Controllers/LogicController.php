<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use DB;
use Str;

class LogicController extends Controller
{
    public function InjectJson(){
        $folderPath = storage_path('app/public/pariwisata_data/*.json');
        foreach (glob($folderPath) as $filepath) {
            $filename = basename($filepath);
            $data = \json_decode(\file_get_contents($filepath),true);
            $wilayah = \App\Models\Wilayah::firstOrCreate([
                "name"=>$filename
            ]);
            // DD($wilayah);
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
                $photos = json_encode($photos);
                $gpi = json_encode($value);
                $rating = $value["rating"] ?? 0;
                DB::raw("insert into places 
                (
                    name,
                    location,
                    rating,
                    photos,
                    google_places_api,
                    wilayah_id
                ) 
                values (
                    {$value["name"]},
                    ST_GeomFromText('POINT(".$value["geometry"]["location"]["lat"]." ".$value["geometry"]["location"]["lng"].")',0),
                    {$rating},
                    {$photos},
                    {$gpi},
                    {$wilayah->id}
                )");
            }
        }
        return "OK";
    }
}
