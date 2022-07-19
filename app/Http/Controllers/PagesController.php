<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use DB;

class PagesController extends Controller
{

    /**
     * View all posts
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $language_id = $request->get('language_id') ?? \App\Helpers\Helper::getLocaleID() ;
        $posts = BinshopsPostTranslation::orderBy("post_id", "desc")
            ->where('lang_id', $language_id)
            ->whereHas("post",function($q){return $q->where("type",1);})
            ->paginate(10);

        return view("binshopsblog_admin::pages.index", [
            'post_translations'=>$posts,
            'language_id' => $language_id
        ]);

    }

    public function show($slug)
    {
        $data["post"] = BinshopsPostTranslation::where("slug",$slug)
        ->with("post",function($q){
            return $q->where("type",1);
        })
        ->firstOrFail();
        return view("template.porto_video.pages",$data);
    }

    public function test()
    {
        $b = BinshopsPost::select("id","type")->where("type",0)->get();
        foreach ($b as $key => $value) {
            DB::table("binshops_post_categories")->insert([
                "post_id"=>$value->id,
                "category_id"=>1,
            ]);
        }
    }
    
}
