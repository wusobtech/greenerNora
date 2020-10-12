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
// Route::get('/shop/{id}/{name}', 'WebController@shop')->name('shops');
Route::get('/frozenfoods', 'WebController@shop')->name('frozenfoods');
Route::get('/lounge', 'WebController@lounge')->name('lounge');
Route::get('/cart', 'CartController@items')->name('cart')->middleware('auth');
Route::get('/contactus', 'WebController@contactus')->name('contactus');
Route::get('/checkout', 'CheckoutController@index')->name('checkout')->middleware('auth');
Route::get('/login', 'WebController@login')->name('login');
Route::get('/productInfo/{id}', 'WebController@product')->name('product');
Route::get('/loungeInfo/{id}', 'WebController@loungeInfo')->name('loungeInfo');
Route::get('/faq', 'WebController@faq')->name('faq');
Route::get('/terms', 'WebController@tandc')->name('terms');
Route::get('/privacypolicy', 'WebController@privacypolicy')->name('privacypolicy');
Route::get('/file/{path}', 'WebController@read_file')->name('read_file');
Route::get('/thank-you', 'WebController@thankyou');
/**Route::get('/product', function($id){
    return view('product');
});
*/

Route::prefix('cart')->as('cart.')->middleware(['auth'])->group(function () {
    Route::match(['get','post'],'/items', 'CartController@items')->name('items');
    Route::match(['get','post'],'/add', 'CartController@addProductToCart')->name('add');
    Route::match(['get','post'],'/remove', 'CartController@removeProductFromCart')->name('remove');
    Route::match(['get','post'],'/checkout', 'CartController@checkout')->name('checkout');
    Route::match(['get','post'],'/checkout/success/{data}', 'CartController@checkoutSuccess')->name('checkout.success');
    Route::post('/update-quantity', 'CartController@updateQuantity')->name('update_quantity');
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

    Route::get('admin/lounge', 'LoungeController@index')->name('adminLounges');
    Route::match(['get','post'],'/submit-lounge', 'LoungeController@store')->name('submitLounge');
    Route::match(['get','post'],'/edit-lounge/{id}','LoungeController@edit')->name('editLounge');
    Route::match(['get','post'],'/update-lounge/{id}','LoungeController@update')->name('updateLounge');
    Route::match(['get', 'post'],'lounge-delete/{id}', 'LoungeController@destroy')->name('deleteLounge');

    Route::get('/unapproved-orders-list','OrderController@unapproved_orders')->name('unapproved_orders');
    Route::get('/verify-order-info/{id}', 'OrderController@verify_order_info')->name('verify_order_info');
    Route::post('/verify-order-status/{id}', 'OrderController@verify_order_status')->name('verify_order_status');
    Route::get('/approved-orders-list', 'OrderController@approved_orders')->name('approved_orders');
    Route::get('/declined-orders-list', 'OrderController@declined_orders')->name('declined_orders');
    Route::get('/order','OrderController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user-order', 'HomeController@order')->name('user-order');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::match(['get','post'],'/profile', 'ProfileController@update')->name('profile.update');
Route::match(['get','post'],'/setting', 'ProfileController@changeProfile')->name('profile.changeprofile');

//Blling Address Routes
Route::post('/save-address', 'CheckoutController@store')->name('submitAddress');
Route::post('/update-address', 'CheckoutController@update')->name('updateAddress');

// Place Order
Route::match(['get','post'],'/place-order', 'CheckoutController@placeOrder')->name('placeOrder');
Route::get('/payment/callback', 'CheckoutController@handleGatewayCallback');

Route::get('/command', function() {
    $output = [];  //'--path' => 'vendor/laravel/passport/database/migrations'
    \Artisan::call('migrate', $output);
    dd($output);
});
Route::get('search', 'WebController@search')->name('search');
Route::get('/receipt', 'CheckoutController@receipt');
Route::get('/thank-you', 'CheckoutController@thankyou');
Route::post('/submitContactForm', 'WebController@submitContact')->name('submitContact');
