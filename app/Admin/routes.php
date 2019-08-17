<?php

use Illuminate\Routing\Router;
//use App\Admin\Actions\Post\Sku;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('sku/{id}','SkuController@skuDetail');
    $router->get('/sku-detail-update', 'SkuController@skuUpdate');


    $router->post('skuInsert/','SkuController@skuInsert');

    $router->resource('sku', SkuController::class);
    $router->resource('goods', GoodsController::class);

});
