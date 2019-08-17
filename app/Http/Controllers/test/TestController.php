<?php

namespace App\Http\Controllers\test;

use App\Model\GoodsModel;
use App\Model\MerModel;
use App\Model\SkuModel;
use App\Model\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * 查询商户
     */
    public function mer()
    {
        $id=1;
        $user = UsersModel::find($id)->mer->toArray();
        var_dump($user);
    }

    /**
     * 查询用户
     */
    public function user()
    {
        $mer_id = 2;
        $mer = MerModel::find($mer_id)->getUser->toArray();
        var_dump($mer);
    }

    /**
     * 查询商品
     */
    public function goods()
    {
        $id = 2;
        $goods = GoodsModel::find($id)->sku->toArray();
        var_dump($goods);
    }

    /**
     * 查询规格
     */
    public function sku()
    {
        $id=2;
        $sku = SkuModel::find($id)->goods->toArray();
        var_dump($sku);
    }
}