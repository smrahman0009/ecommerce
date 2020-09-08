<?php

use App\Product;
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

Route::get('/','FrontEndController@index')->name('index');
Route::get('product/details/{id}','FrontEndController@product')->name('product.details');

Route::post('cart/add/','ShoppingController@addToCart')->name('cart.add');
Route::get('cart/auick/add/{id}','ShoppingController@quickAddToCart')->name('cart.quick.add');
Route::get('cart/','ShoppingController@viewCart')->name('cart.view');
Route::get('cart/remove/{rowId}','ShoppingController@removeItem')->name('cart.remove');
Route::get('cart/increment/{rowId}/{quantity}','ShoppingController@increment')->name('cart.increment');
Route::get('cart/decrement/{rowId}/{quantity}','ShoppingController@decrement')->name('cart.decrement');

Route::get('cart/checkout/','ShoppingController@cartCheckout')->name('cart.checkout');
Route::post('cart/checkout/','ShoppingController@pay')->name('cart.pay');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function (){

    Route::resource('product','ProductController');

});


