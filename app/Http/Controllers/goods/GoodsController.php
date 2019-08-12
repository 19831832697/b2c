<?php

namespace App\Http\Controllers\goods;

use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * 商品展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsShow()
    {
        $arr = GoodsModel::all();
        return view('goods.goods',['arr'=>$arr]);
    }

    /**
     * 商品详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsDetail(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $where=[
            'goods_id'=>$goods_id,
            'goods_shelf'=>1
        ];
        $data = GoodsModel::where($where)->first();
        return view('goods.goodsList',['data'=>$data]);
    }
}
