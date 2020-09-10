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
Route::get('/', 'WebController@index')->name('homepage');
Route::get('/shop', 'WebController@shop')->name('shop');
Route::get('/shop/{id}/{name}', 'WebController@shop')->name('shops');
Route::get('/frozenfoods', 'WebController@shop')->name('frozenfoods');
Route::get('/lounge', 'WebController@lounge')->name('lounge');
Route::get('/cart', 'CartController@items')->name('cart')->middleware('auth');
Route::get('/contactus', 'WebController@contactus')->name('contactus');
Route::get('/login', 'WebController@login')->name('login');
Route::get('/productInfo/{id}', 'WebController@product')->name('product');
Route::get('/file/{path}', 'WebController@read_file')->name('read_file');



Route::prefix('cart')->as('cart.')->middleware(['auth'])->group(function () {
    Route::match(['get','post'],'/items', 'CartController@items')->name('items');
    Route::match(['get','post'],'/add', 'CartController@addProductToCart')->name('add');
    Route::match(['get','post'],'/remove', 'CartController@removeProductFromCart')->name('remove');
    Route::match(['get','post'],'/checkout', 'CartController@checkout')->name('checkout');
    Route::match(['get','post'],'/checkout/success/{data}', 'CartController@checkoutSuccess')->name('checkout.success');
});



Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','HomeController@logout');

Route::group(['middleware'=> ['admin']],function(){
    Route::get('/admin/dashboard', 'AdminController@index')->name('admin');

    Route::get('admin/categories', 'ProductCategoryController@index')->name('adminCategories');
    Route::match(['get','post'],'/submit-category', 'ProductCategoryController@store')->name('submitCategory');
    Route::match(['get','post'],'/edit-category/{id}','ProductCategoryController@edit')->name('editCategory');
    Route::match(['get','post'],'/update-category/{id}','ProductCategoryController@update')->name('updateCategory');
    Route::match(['get','post','delete'],'category-delete/{id}' , 'ProductCategoryController@destroy')->name('deleteCategory');

    Route::get('admin/products', 'ProductController@index')->name('adminProducts');
    Route::match(['get','post'],'/submit-product', 'ProductController@store')->name('submitProduct');
    Route::match(['get','post'],'/edit-product/{id}','ProductController@edit')->name('editProduct');
    Route::match(['get','post'],'/update-product/{id}','ProductController@update')->name('updateProduct');
    Route::match('product-delete/{id}' , 'ProductController@destroy')->name('deleteProduct');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/command', function() {
    $output = [];  //'--path' => 'vendor/laravel/passport/database/migrations'
    \Artisan::call('migrate', $output);
    dd($output);
});
