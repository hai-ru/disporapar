<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;

class DestinationsController extends Controller
{
    public function index(Request $request,String $slug = "")
    {
        $data["category_place"] = $slug;
        $cat = \App\Models\CategoryPlace::where("slug",$slug)->first();
        $data["category_place_id"] = $cat->id ?? "";
        $lang_id = $request->get('language_id') ?? \App\Helpers\Helper::getLocaleID() ;
        $data["category"] = \App\Models\CategoryPlace::where("lang_id",$lang_id)
        ->orderBy("order_at")->get();
        $data["wilayah"] = \App\Models\Wilayah::orderBy("created_at","desc")->get();
        return view("template.porto_video.destinations",$data);
    }
    
    public function recap(Request $request)
    {
        $query = \App\Models\Place::select("id","alamat","slug","name","phone","rating","description","category_place_id","wilayah_id","photos")
        ->addSelect(DB::raw("ST_X(location) as latitude, ST_Y(location) as longitude"))
        ->with("wilayah","category_place")
        ->orderBy("created_at","asc");

        return Datatables::of($query)->make(true);
    }

    public function load_markers(Request $request){

        $place = \App\Models\Place::select("id","alamat","slug","name","phone","rating","description","category_place_id","wilayah_id","photos")
        ->addSelect(DB::raw("ST_X(location) as latitude, ST_Y(location) as longitude"))
        ->with("wilayah","category_place")
        ->orderBy("created_at","asc");

        if($request->has("wilayah_id") && !empty($request->wilayah_id)){
            $place = $place->where("wilayah_id",$request->wilayah_id);
        }
        if($request->has("name")){
            $place = $place->where("name","like","%".$request->name."%");
        }
        if($request->has("category_place") && !empty($request->category_place) && intval($request->category_place) !== 10){
            $place = $place->where("category_place_id",$request->category_place);
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

    public function home(Request $request){
        $language_id = $request->get('language_id') ?? \App\Helpers\Helper::getLocaleID() ;
        $data["news"] = BinshopsPostTranslation::orderBy("created_at", "desc")
            ->where('lang_id', $language_id)
            ->whereHas("post",function($q){return $q->where("type",0);})
            ->take(10)
            ->get();
        $data["destinations"] = \App\Models\Place::where("featured",1)->take(10)->get();
        $data["link_terkait"] = \App\Models\LinkTerkait::orderBy("created_at","desc")->take(10)->get();
        return view('template.porto_video.index',$data);
    }

    public function show(Request $request,String $slug = "")
    {
        $data["place"] = \App\Models\Place::where("slug",$slug)
        ->addSelect(DB::raw("*, ST_X(location) as latitude, ST_Y(location) as longitude"))
        ->firstorfail();
        $data["nearest"] = DB::select(DB::raw("SELECT *, (ST_Distance(location, POINT( {$data["place"]->latitude}, {$data["place"]->longitude})) * 111195) / 1000 as distance FROM `places` WHERE id != {$data["place"]->id} order by distance ASC LIMIT 5"));
        $data["related"] = \App\Models\Place::where("category_place_id",$data["place"]->category_place_id)
        ->where("wilayah_id",$data["place"]->wilayah_id)
        ->orderBy("views","desc")
        ->take(5)
        ->get();
        return view("template.porto_video.places",$data);
    }
}
