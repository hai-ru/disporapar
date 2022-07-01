<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\PagesController;
use \App\Http\Controllers\DestinationsController;
use \App\Http\Controllers\LogicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('template.porto_video.index');
})->name("/");

Route::get('/pages/{slug}', [PagesController::class,"show"])->name("pages");

Route::get('/places/{slug}', [DestinationsController::class,"show"])->name("pages.index");
Route::get('/destinations/{slug?}', [DestinationsController::class,"index"])->name("destinations");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware"=>"auth"],function(){
    Route::get("admin/pages",[PagesController::class,"index"])->name("admin.pages");
    Route::get("admin/filemanager",function(){
        return view('binshopsblog_admin::filemanager');
    })->name("filemanager");
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get("test",function(){
    $places = \App\Models\Place::select("id","name","photos","google_places_api")->get();
    foreach($places as $place){
        $place->alamat = $place->google_places_api["vicinity"] ?? null;
        $place->save();
    }
    return $places;
});