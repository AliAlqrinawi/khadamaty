<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\SettingController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth']);

Auth::routes();


Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['auth']], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(AdsController::class)->group(function () {
        Route::get('ads', 'ads')->name('ads');

        Route::get('ads/get', 'get_ads')->name('get_ads');

        Route::post('ads/add' , 'add_ads')->name('add_ads');

        Route::get('ads/edit/{id}' , 'edit')->name('ads.edit');

        Route::post('ads/update/{id}' , 'update')->name('ads.update');

        Route::delete('ads/delete/{id}' , 'delete')->name('ads.delete');
    });
});
Route::post('ads/update/status', [AdsController::class , 'updateStatus'])->name('ads.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('category', 'category')->name('category');

        Route::get('categories/get', 'get_categories')->name('get_categories');

        Route::post('category/add' , 'add_category')->name('add_category');

        Route::get('category/edit/{id}' , 'edit')->name('category.edit');

        Route::post('category/update/{id}' , 'update')->name('category.update');

       Route::delete('category/delete/{id}' , 'delete')->name('category.delete');
    });
});
Route::post('category/update/status', [CategoriesController::class , 'updateStatus'])->name('update.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(ProvincesController::class)->group(function () {
        Route::get('countries', 'Provinces')->name('countries');

        Route::get('countries/get', 'get_Provinces')->name('get_governorates');

        Route::post('countries/add' , 'add_governorat')->name('add_governorat');

        Route::get('countries/edit/{id}' , 'edit')->name('governorat.edit');

        Route::post('countries/update/{id}' , 'update')->name('governorat.update');

        Route::delete('countries/delete/{id}' , 'delete')->name('governorat.delete');
    });
});Route::post('countries/update/status', [ProvincesController::class , 'updateStatus'])->name('countries.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(RegionsController::class)->group(function () {
        Route::get('cities', 'cities')->name('cities');

        Route::get('cities/get', 'get_cities')->name('get_cities');

        Route::post('cities/add' , 'add_Cities')->name('add_cities');

        Route::get('city/edit/{id}' , 'edit')->name('city.edit');

        Route::post('city/update/{id}' , 'update')->name('city.update');

        Route::delete('city/delete/{id}' , 'delete')->name('city.delete');

        Route::get('city/{id}', 'index_show')->name('city.show');

        Route::get('city/show/{id}', 'show')->name('get_show_city');
    });
});
Route::post('city/update/status', [RegionsController::class , 'updateStatus'])->name('city.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
    'middleware' => ['auth']
],  function () {
        Route::get('setting/global' , [SettingController::class , 'index'])->name('setting.global');
        Route::get('setting/social' , [SettingController::class , 'social'])->name('setting.social');
        Route::post('update/setting/global' , [SettingController::class , 'update'])->name('setting.update');
});
