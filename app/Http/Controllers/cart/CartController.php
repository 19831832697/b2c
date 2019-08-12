<?php

namespace App\Http\Controllers\cart;

use App\Model\CartModel;
use App\Model\GoodsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * 加入购物车
     * @param Request $request
     * @return false|string
     */
    public function addCart(Request $request)
    {
        $goods_id = $request->input('goods_id');
        $user_id = Auth::id();
        if(empty($user_id)){
            $arr = [
                'code' => 2,
                'msg' => '您还没有登录哦'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
        $where=[
            'goods_id'=>$goods_id,
        ];
        $goodsInfo = GoodsModel::where($where)->first();

        $whereInfo = [
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $cartInfo = CartModel::where($whereInfo)->first();

        if($cartInfo){
            $status = $cartInfo->status;
            $updateInfo=[
                'status'=>1,
            ];
            if($status == 2){
                CartModel::where($whereInfo)->update($updateInfo);
            }

            $buy_num = $cartInfo->buy_num;
            $num = 1;
            $arrInfo=[
                'buy_num'=>$buy_num + $num,
                'create_time'=>time()
            ];
            if($goodsInfo->goods_num >= $arrInfo['buy_num']){
                $cart = CartModel::where($whereInfo)->update($arrInfo);
            }else{
                $arr = [
                    'code' => 1,
                    'msg' => '商品库存不足，去看看其他的吧'
                ];
                return json_encode($arr,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $arrInfo=[
                'goods_id'=>$goodsInfo->goods_id,
                'user_id'=>$user_id,
                'goods_name'=>$goodsInfo->goods_name,
                'status'=>1,
                'buy_num'=>1,
                'create_time'=>time()
            ];
            $cart = CartModel::insert($arrInfo);
        }
        if($cart){
            $arr = [
                'code' => 0,
                'msg' => '商品成功加入购物车'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr = [
                'code' => 1,
                'msg' => '加入购物车失败了'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 购物车列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cartList()
    {
        $user_id = Auth::id();
        if(empty($user_id)){
            $arr = [
                'code' => 1,
                'msg' => '您还没有登录，请先登录'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
        $where=[
            'user_id'=>$user_id,
            'status'=>1
        ];
        $arr = DB::table('shop_cart')->where($where)->get();
        $cartDetail = DB::table('shop_cart')
                ->join('shop_goods','shop_cart.goods_id','=','shop_goods.goods_id')
                ->where($where)
                ->get();
        return view('cart.cartList',['arr'=>$cartDetail]);
    }

    /**
     * 购物车删除
     * @param Request $request
     * @return false|string
     */
    public function cartDel(Request $request)
    {
        $user_id = Auth::id();
        $goods_id = $request->input('goods_id');
        $where = [
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $updateInfo=[
            'status'=>2,
            'buy_num'=>0
        ];
        $res = CartModel::where($where)->update($updateInfo);
        if($res){
            $arr = [
                'code' => 0,
                'msg' => '移除购物车成功'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr = [
                'code' => 1,
                'msg' => '移除购物车失败'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 点击减号
     * @param Request $request
     * @return false|string
     */
    public function cartJian(Request $request)
    {
        $user_id = Auth::id();
        $buy_num = $request->input('buy_num');
        $goods_id = $request->input('goods_id');
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id
        ];
        if($buy_num <= 1){
            $arr = [
                'code'=>1,
                'msg'=>'不能在减了哦'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $num = $buy_num - 1;
            $updateInfo = [
                'buy_num'=>$num
            ];
            CartModel::where($where)->update($updateInfo);
            $arr = [
                'buy_num'=>$num
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 点击加号
     * @param Request $request
     * @return false|string
     */
    public function cartJia(Request $request)
    {
        $buy_num = $request->input('buy_num');
        $goods_id = $request->input('goods_id');
        $where=[
            'user_id'=>1,
            'goods_id'=>$goods_id
        ];
        $goodsInfo = GoodsModel::where(['goods_id'=>$goods_id])->first();
        $goods_num = $goodsInfo->goods_num;
        if($buy_num >= $goods_num){
            $arr = [
                'code'=>1,
                'msg'=>'只有这么多了！'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $buy_num += 1;
            CartModel::where($where)->update(['buy_num'=>$buy_num]);
            $arr = [
                'buy_num'=>$buy_num
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
}
