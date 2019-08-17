<?php

namespace App\Http\Controllers\goods;

use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsSkuController extends Controller
{
    /**
     * 展示商品
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsShow()
    {
        $arr = GoodsModel::all();
        return view('goods.goods',['arr'=>$arr]);
    }

    /**
     * 展示商品详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsDetail(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $where=[
            'shop_goods.goods_id'=>$goods_id
        ];
        $data = DB::table('shop_goods')
            ->join('p_sku','shop_goods.goods_id','=','p_sku.goods_id')
            ->where($where)
            ->first();
        $sku = $data->sku;
        return view('goods.goodsList',['data'=>$data,'sku'=>$sku]);
    }
}
