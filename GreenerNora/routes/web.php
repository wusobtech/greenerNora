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
Route::get('/frozenfoods', 'WebController@shop')->name('frozenfoods');
Route::get('/lounge', 'WebController@lounge')->name('lounge');
Route::get('/cart', 'WebController@cart')->name('cart');
Route::get('/contactus', 'WebController@contactus')->name('contactus');
Route::get('/login', 'WebController@login')->name('login');
Route::get('/product', 'WebController@product')->name('product');
/**Route::get('/product', function($id){
    return view('product');
});
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=> ['admin']],function(){
    Route::get('/admin/dashboard', 'AdminController@index')->name('admin');
});

