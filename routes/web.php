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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('goodsShow','goods\GoodsController@goodsShow');
Route::get('goodsDetail','goods\GoodsController@goodsDetail');


Route::get('addCart','cart\CartController@addCart');
Route::get('cartList','cart\CartController@cartList');
Route::get('cartDel','cart\CartController@cartDel');
Route::get('cartJian','cart\CartController@cartJian');
Route::get('cartJia','cart\CartController@cartJia');

Route::get('orderInsert','order\OrderController@orderInsert');
Route::get('orderList','order\OrderController@orderList');

Route::get('z_pay','pay\PayController@z_pay');
Route::post('notify','pay\PayController@notify');//异步回调
Route::get('aliReturn','pay\PayController@aliReturn');//同步回调
