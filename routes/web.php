<?php

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
    return redirect('/home');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/history', 'HomeController@history')->name('history');
Route::get('/contact', 'HomeController@index')->name('contact');
Route::get('/add-cart/{id}', 'HomeController@addCart')->name('add-cart');
Route::get('/count-cart', 'HomeController@getCountCart')->name('count-cart');
Route::get('/list-cart', 'HomeController@listCart')->name('list-cart');
Route::get('/custom-qty/{id}/{type}', 'HomeController@customQty')->name('custom-qty');
Route::get('/remove-cart/{id}', 'HomeController@removeCart')->name('remove-cart');
Route::post('/calculate-cart', 'HomeController@calculateCart')->name('calculate-cart');
Route::post('/checkout-cart', 'HomeController@checkoutCart')->name('checkout-cart');
