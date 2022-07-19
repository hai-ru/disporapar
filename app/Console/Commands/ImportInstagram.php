<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use BinshopsBlog\Models\BinshopsPost;
use BinshopsBlog\Models\BinshopsPostTranslation;
use \Carbon\Carbon;
use Str;
use DB;

class ImportInstagram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:instagram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'For Scraping instagram';

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

        $file = storage_path("app/public/lemlit/data_sosmed.json");
        try {
            $json = json_decode(file_get_contents($file),true);
            DB::beginTransaction();
            $total_video = count($json["video"]);
            $total_timeline = count($json["timeline"]);
            echo "video : ".$total_video."\n";
            echo "timeline : ".$total_timeline."\n";
            
            foreach ($json["video"] as $key => $value) {
                echo "video {$key}/{$total_video} \n";
                $this->process_data($value["node"],$key);
            }
            foreach ($json["timeline"] as $key => $value) {
                echo "timeline {$key}/{$total_video} \n";
                $this->process_data($value["node"],$key,"timeline");
                // die;
            }

            DB::commit();
           
            
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            echo $th->getLine()." ".$th->getMessage();
        }

    }

    public function process_data($video,$key,$uniq = "video")
    {
        // $video = $value["node"];
        $save_path = storage_path("app/public");
        $video_name = "/video/{$uniq}_{$key}.mp4";
        $file_name = $save_path.$video_name;
        if(!file_exists($file_name) && $video["is_video"]){
            $this->download($file_name,$video["video_url"]);
        }
        $title = count($video["edge_media_to_caption"]["edges"]) > 0 ? $video["edge_media_to_caption"]["edges"][0]["node"]["text"] : "video ".$key;
        $image_large = "/foto_ig/large-{$key}-{$video["dimensions"]["height"]}x{$video["dimensions"]["width"]}.jpg";
        $this->download($save_path.$image_large,$video["display_url"]);
        $val = $video["thumbnail_resources"];
        $image_medium = "/foto_ig/medium-0-{$key}-{$val[0]["config_height"]}x{$val[0]["config_width"]}.jpg";
        $this->download($save_path.$image_medium,$val[0]["src"]);
        $last = count($video["thumbnail_resources"])-1;
        $image_thumbnail = "/foto_ig/thumbnail-{$key}-{$val[$last]["config_height"]}x{$val[$last]["config_width"]}.jpg";
        $this->download($save_path.$image_thumbnail,$val[$last]["src"]);
        $input = [
            "title"=>$title,
            "post_body"=>$title,
            "image_large"=>$image_large,
            "image_medium"=>$image_medium,
            "image_thumbnail"=>$image_thumbnail
        ];
        if($video["is_video"]) $input["video"] = $video_name;
        $this->addtoDatabase($input);
    }

    public function addtoDatabase(Array $request)
    {
        $new_blog_post = new BinshopsPost();
        $translation = new BinshopsPostTranslation();

        $new_blog_post->posted_at = Carbon::now();
        $new_blog_post->is_published = 1;
        $new_blog_post->user_id = 1;
        $new_blog_post->type = 0;
        $new_blog_post->save();

        $translation->title = Str::limit($request['title'],20);
        $translation->subtitle = "";
        $translation->short_description = "";
        $translation->post_body = nl2br($request['post_body']);
        $translation->seo_title = $translation->title;
        $translation->meta_desc = strip_tags($request['post_body']);
        $translation->slug = Str::slug($translation->title);
        $translation->use_view_file = null;
        $translation->video = $request["video"] ?? null;
        $translation->image_large = $request["image_large"] ?? null;
        $translation->image_medium = $request["image_medium"] ?? null;
        $translation->image_thumbnail = $request["image_thumbnail"] ?? null;

        $translation->lang_id = 2;
        $translation->post_id = $new_blog_post->id;
        $translation->save();
    }

    public function download($dir,$target)
    {
        if(file_exists($dir)){
            echo "file exist : {$dir} \n";
            return null;
        } 
        file_put_contents($dir,file_get_contents($target));
    }
}
