<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;

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
        // $language_id = $request->language_id;
        // DD($request->all(),$request->get('language_id'));
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
        // DD($data);
        return view("template.porto_video.pages",$data);
    }
}
