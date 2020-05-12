<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

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

Route::get('/', 'HomeController@index');
Route::get('/products', 'ProductController@index');
Route::get('/product/{slug}', 'ProductController@show');

Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@store');
Route::delete('/cart/{id}', 'CartController@destroy');
Route::post('/cart/saveForLater/{id}', 'CartController@saveForLater');

Route::delete('/saveForLater/{id}', 'SaveForLaterController@destroy');
Route::post('saveForLater/moveToCart/{id}', "SaveForLaterController@moveToCart");

Route::get('/checkout', 'CheckoutController@checkout');

Route::get('/cart/empty', function(){
    Cart::destroy();
});

Auth::routes();
