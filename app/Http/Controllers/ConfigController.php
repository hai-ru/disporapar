<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            \App\Models\config::first()->update($data);
            return ['status'=>'success','message'=>'Data berhasil disimpan'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['status'=>'error','message'=>$th->getMessage()];
        }
    }
}
