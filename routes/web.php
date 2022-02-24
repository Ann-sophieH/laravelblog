<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    return view('index');
});

Auth::routes();


/***BACKEND ROUTES ***/
//
/*
Route::middleware(['auth'])->group(function (){
    //Route::resource('admin/users', App\Http\Controllers\AdminUsersController::class); 1 per 1 beveiligen

});
*/ //als de prefix = admin is dan gaan we er middleware aan koppelen => alles onder admin beveiligd
Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){

    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('homebackend');
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
});
