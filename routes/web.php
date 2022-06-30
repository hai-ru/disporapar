<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\PagesController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware"=>"auth"],function(){
    Route::get("admin/pages",[PagesController::class,"index"])->name("admin.pages");
});
