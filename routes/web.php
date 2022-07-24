<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\PagesController;
use \App\Http\Controllers\DestinationsController;
use \App\Http\Controllers\LogicController;
use \App\Http\Controllers\CollectingController;

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

Route::get('/', [DestinationsController::class,"home"])->name("/");

Route::get('/recap', function(){return view("template.porto_video.recap");})->name("recap");
Route::get('/recap-data', [DestinationsController::class,"recap"])->name("recap.data");
Route::get('/pages/{slug}', [PagesController::class,"show"])->name("pages");
Route::get('/collecting/{slug}', [CollectingController::class,"show"])->name("collecting");
Route::get('/collecting-data', [CollectingController::class,"data"])->name("collecting.data");
Route::post('/collecting/{slug}', [CollectingController::class,"store"])->name("collecting.store");
Route::get('/places/{slug}', [DestinationsController::class,"show"])->name("places");
Route::post('/places/search', [DestinationsController::class,"search"])->name("places.search");
Route::get('/destinations/{slug?}', [DestinationsController::class,"index"])->name("destinations");
Route::post('/destinations', [DestinationsController::class,"update"])->name("destinations.update");
Route::post('/kecamatan', [DestinationsController::class,"kecamatan"])->name("kecamatan.data");

Route::post('/upload-image', [DestinationsController::class,"uploadImage"])->name("destinations.upload");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["prefix"=>"admin","middleware"=>"auth"],function(){
    Route::get("pages",[PagesController::class,"index"])->name("admin.pages");
    Route::get("pages/data",[PagesController::class,"data"])->name("admin.pages.data");
    Route::post("destinations/delete",[DestinationsController::class,"delete"])->name("admin.destination");
    Route::get("filemanager",function(){
        return view('binshopsblog_admin::filemanager');
    })->name("filemanager");
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get("test",[PagesController::class,"test"]);