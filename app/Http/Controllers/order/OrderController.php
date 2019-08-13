<?php

namespace App\Http\Controllers\order;

use App\Model\CartModel;
use App\Model\MerModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * 生成订单
     * @param Request $request
     * @return false|string
     */
    public function orderInsert(Request $request)
    {
        $user_id = Auth::id();
        $goods_id = rtrim($request->input('goods_id'), ',');
        $goodsId = explode(',', $goods_id);
        $order_amount = $request->input('total');
        if (empty($user_id)) {
            $arr = [
                'code' => 2,
                'msg' => '您还没有登录，请先登录'
            ];
            return json_encode($arr, JSON_UNESCAPED_UNICODE);
        }
        if (empty($goods_id)) {
            $arr = [
                'code' => 1,
                'msg' => '请至少选择一件商品去结算'
            ];
            return json_encode($arr, JSON_UNESCAPED_UNICODE);
        }

//        $mer = DB::table('merchant')
//            ->join('shop_goods','shop_goods.mer_id','=','merchant.mer_id')
//            ->join('shop_cart','shop_goods.goods_id','=','shop_cart.goods_id')
//            ->where('goods_shelf',1)
//            ->get();
//        $arr = json_decode($mer,true);
//
//        var_dump($arr);die;

        $where = [
            'goods_id' => $goods_id,
            'user_id' => 1,
            'status' => 1
        ];
        //生成订单入库
        $order_no = date("YmdHis", time()) . rand(1000, 9999);
        $orderInfo = [
            'order_amount' => $order_amount,
            'order_no' => $order_no,
            'user_id' => 1
        ];
        $order_id = OrderModel::insertGetId($orderInfo);

        //订单详情入库
        $arrInfo = DB::table('shop_goods')
            ->join('shop_cart', 'shop_goods.goods_id', '=', 'shop_cart.goods_id')
            ->where('status', 1)
            ->whereIn('shop_goods.goods_id', $goodsId)
            ->get()->toArray();
//        var_dump($arrInfo);die;
        if (!empty($arrInfo)) {
            foreach ($arrInfo as $k => $v) {
                $arr = [
                    'goods_id' => $v->goods_id,
                    'user_id' => $user_id,
                    'order_no' => $order_no,
                    'order_id' => $order_id,
                    'goods_price' => $v->goods_price,
                    'goods_name'=>$v->goods_name,
                    'buy_num' => $v->buy_num,
                    'ctime' => time()
                ];
                $orderDetail = DB::table('shop_order_detail')->insert($arr);
            }
            if ($orderInfo) {
                $updateInfo = [
                    'status' => 2
                ];
                CartModel::where($where)->whereIn('goods_id', $goodsId)->update($updateInfo);
                $res = [
                    'code' => 200,
                    'order_no' => $order_no
                ];
                return json_encode($res, JSON_UNESCAPED_UNICODE);
            } else {
                $res = [
                    'code' => 40020,
                    'msg' => '没有此商品'
                ];
                return json_encode($res, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    /**
     * 展示订单详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderList(Request $request)
    {
        $order_no = $request->input('order_no');
        $user_id = Auth::id();
        $where = [
            'shop_order_detail.order_no' => $order_no,
            'shop_order_detail.user_id' => $user_id
        ];
        $arrInfo = DB::table('shop_goods')
            ->join('shop_order_detail','shop_goods.goods_id','=','shop_order_detail.goods_id')
            ->join('shop_order','shop_order.order_id','=','shop_order_detail.order_id')
            ->where($where)->get();
        $arr = json_decode($arrInfo,true);
        return view('order.orderList',['arr'=>$arr,'order_no'=>$order_no]);
    }
}
