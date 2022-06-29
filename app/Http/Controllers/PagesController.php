<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;

class PagesController extends Controller
{
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
