<?php 

namespace App\Helpers;

use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use BinshopsBlog\Models\BinshopsLanguage;

class Helper
{
    public static function getThemeAssets(){
        return "/theme/porto_video/";
    }

    public static function getPost($config = []){
        $lang = BinshopsLanguage::where("locale",app()->getLocale())->first();
        $query = BinshopsPostTranslation::where("lang_id",$lang->id);
        if(isset($config["popular"])){
            return $query->orderBy("views")->get();
        }
        return $query->orderBy("created_at")->get();
    }
}

