<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UploadImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['preventbackbutton','auth']], function () {
    Route::get('/',[HomeController::class,'index']);
    Route::post('/upload_image',[UploadImageController::class,'upload_image'])->name('upload.image');
    Route::post('/code_secondary',[HomeController::class,'getSecondary'])->name('get.code.secondary');
    Route::post('/store',[HomeController::class,'store'])->name('store');
    Route::post('/read_storage',[HomeController::class,'readStorage'])->name('read.storage');
    Route::post('delete_upload_photos', [HomeController::class,'delete_upload_photos'])->name('delete.upload.photos');

    Route::post('read_storage_final', 'Frontend\HomeController@readstorageFinal')->name('read.storage.final');

});



Route::group(['middleware' => ['auth','isAdmin']], function () {
    Route::prefix('/administrator')->group(function () {
        Route::get('/', 'Backend\MainController@index');
        Route::get('details', 'Backend\MainController@detail')->name('details');
        Route::get('report_upload', 'Backend\MainController@report')->name('report.upload');
        Route::post('compare_date', 'Backend\MainController@compare_date')->name('compare.date');
        Route::post('get_user_upload', 'Backend\MainController@count_upload_user')->name('get.user.upload');
    });
    });

Route::get('reset', 'Frontend\HomeController@reset')->name('reset');
Route::post('resetPa','Frontend\HomeController@resetPass')->name('reset.pa');
Route::get('/movefile', 'Frontend\HomeController@movefile');
//Route::get('/home', 'HomeController@index')->name('home');
