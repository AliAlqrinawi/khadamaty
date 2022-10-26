<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FavsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PackageOrdersController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UsersController;
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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(PackagesController::class)->group(function () {
        Route::get('packages', 'package')->name('package');

        Route::get('packages/get', 'get_packages')->name('get_packages');

        Route::post('package/add' , 'add_package')->name('add_package');

        Route::get('package/edit/{id}' , 'edit')->name('package.edit');

        Route::post('package/update/{id}' , 'update')->name('package.update');

        Route::delete('package/delete/{id}' , 'delete')->name('package.delete');
    });
});
Route::post('package/update/status', [PackagesController::class , 'updateStatus'])->name('package.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(OrdersController::class)->group(function () {
        Route::get('orders', 'orders')->name('orders');

        Route::get('orders/get', 'get_orders')->name('get_orders');

        Route::delete('order/delete/{id}' , 'delete')->name('order.delete');
    });
});
// Route::post('package/update/status', [PackagesController::class , 'updateStatus'])->name('package.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(PackageOrdersController::class)->group(function () {
        Route::get('PackageOrder', 'PackageOrder')->name('PackageOrder');

        Route::get('PackageOrder/get', 'get_PackageOrder')->name('get_PackageOrder');

        Route::delete('PackageOrder/delete/{id}' , 'delete')->name('PackageOrder.delete');
    });
});
Route::post('PackageOrder/update/status', [PackageOrdersController::class , 'updateStatus'])->name('PackageOrder.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(FavsController::class)->group(function () {
        Route::get('Fav', 'Fav')->name('Fav');

        Route::get('Fav/get', 'get_Fav')->name('get_Fav');

        Route::delete('Fav/delete/{id}' , 'delete')->name('Fav.delete');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
        // 'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(UsersController::class)->group(function () {
        Route::get('admins', 'admins')->name('admins');

        Route::get('admins/get', 'get_admins')->name('get_admins');

        Route::post('admin/add' , 'add_admin')->name('add_admin');

        Route::get('admin/edit/{id}' , 'edit')->name('admin.edit');

        Route::post('admin/update/{id}' , 'update')->name('admin.update');

        Route::delete('admin/delete/{id}' , 'delete')->name('admin.delete');

        Route::get('workers', 'workers')->name('workers');

        Route::get('workers/get', 'get_workers')->name('get_workers');

        Route::get('customers', 'customers')->name('customers');

        Route::get('customers/get', 'get_customers')->name('get_customers');
    });
});
Route::post('admin/update/status', [UsersController::class , 'updateStatus'])->name('admin.status');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()."/admin",
    // 'prefix' => "dashbord",
    'middleware' => ['auth']
],  function () {
        Route::resource( 'roles' , RolesController::class);
        Route::get('show/{id}/{user_id}' , [RolesController::class , 'edit_role'])->name('edit_role');
        Route::post('update/r/{id}' , [RolesController::class , 'update'])->name('edit_role');
        Route::get('get_roles' , [RolesController::class , 'get_roles'])->name('get_roles');
        Route::delete('destroy/{id}/{user_id}' , [RolesController::class , 'destroy'])->name('destroy');
});
