<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Datatables;

class CollectingController extends Controller
{
    public function show($id)
    {
        $data["category"] = \App\Models\ColectingCategory::findorfail($id);
        $data["form"] = $data["category"]->collecting_form;
        $data["id"] = $id;
        return view("template.porto_video.form-collecting",$data);
    }

    public function store(Request $request)
    {
        $cat_id = intval($request->category_id);
        $attach_to = intval($request->attach_to);
        $data = $request->all();
        unset(
            $data["category_id"],
            $data["attach_to"],
        );
        $attach = "\App\Models\Place";
        \App\Models\ColectingStore::where("attach_to",$attach_to)->delete();
        foreach ($data as $key => $value) {
            $input = [
                "colecting_forms_id"=>$key,
                "colecting_categories_id"=>$cat_id,
                "attach_models"=>$attach,
                "attach_to"=>$attach_to,
                "value"=>$value
            ];
            \App\Models\ColectingStore::create($input);
        }
        return ["status"=>true,"message"=>"Data berhasil disimpan"];
    }

    public function data(Request $request)
    {
        $query = \App\Models\Place::select("*")
        ->addSelect(DB::raw("ST_X(location) as latitude, ST_Y(location) as longitude"))
        ->where("active",1)
        ->with("wilayah","category_place","form_store")
        ->orderBy("created_at","asc");

        $table = Datatables::of($query);
        $c = \App\Models\ColectingCategory::find($request->id);
        foreach ($c->collecting_form as $key => $value) {
            $table->addColumn($value->column_name,function($q) use($value){
                $form = $q->form_store->where("colecting_forms_id",$value->id)->first();
                if(empty($form)) return "-";
                return $form->value;
            });
        }
        $table->editColumn('alamat',function($q){
            return $q->alamat();
        });
        $table->rawColumns(['alamat']);
        return $table->make(true);
    }
}
