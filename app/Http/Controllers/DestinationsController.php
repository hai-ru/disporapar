<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DestinationsController extends Controller
{
    public function index(Request $request,String $slug = "")
    {
        $data["category_place"] = $slug;
        $lang_id = $request->get('language_id') ?? \App\Helpers\Helper::getLocaleID() ;
        $data["category"] = \App\Models\CategoryPlace::where("lang_id",$lang_id)
        ->orderBy("created_at")->get();
        $data["wilayah"] = \App\Models\Wilayah::orderBy("created_at","desc")->get();
        return view("template.porto_video.destinations",$data);
    }

    public function load_markers(Request $request){

        $lang_id = $request->get('language_id') ?? \App\Helpers\Helper::getLocaleID() ;

        $place = \App\Models\Place::select("id","alamat","slug","name","phone","rating","description","category_place_id","wilayah_id","photos")
        ->addSelect(DB::raw("ST_X(location) as latitude, ST_Y(location) as longitude"))
        ->addSelect(DB::raw('photos -> "$[0]" as cover'))
        ->with("wilayah","category_place")
        ->orderBy("created_at","asc");

        if($request->has("wilayah_id") && !empty($request->wilayah_id)){
            $place = $place->where("wilayah_id",$request->wilayah_id);
        }
        if($request->has("name")){
            $place = $place->where("name","like","%".$request->name."%");
        }

        if($request->has("take")){
            $place = $place->take($request->take);
        }
        
        return [
            "status"=>true,
            "total_records"=>$place->count(),
            "query"=>$place->toSql(),
            "data"=>$place->get()
        ];
    }
}
