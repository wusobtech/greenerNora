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
Route::get('/', 'WebController@index');
Route::get('/shop', 'WebController@shop')->name('shop');
Route::get('/cart', 'WebController@cart')->name('cart');
Route::get('/product', 'WebController@product')->name('product');
/**Route::get('/product', function($id){
    return view('product');
});
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
