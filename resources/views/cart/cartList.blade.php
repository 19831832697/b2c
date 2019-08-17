<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>购物车列表</title>
</head>
<body>
<h1>购物车列表</h1>
<table border = 1>
    <tr>
        <td>选择</td>
        <td>商品名称</td>
        <td>商品描述</td>
        <td>商品价格</td>
        <td>购买数量</td>
        <td>操作</td>
    </tr>
    @foreach($arr as $v)
    <tr goods_id="{{$v->goods_id}}">
        <td><input type="checkbox" class="box"></td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_desc}}</td>
        <td><strong id="price">{{$v->goods_price * $v->buy_num}}</strong></td>
        <td>
            <button class="jian" buy_num="{{$v->buy_num}}" goods_id="{{$v->goods_id}}">－</button>
            <span id="buy_num">{{$v->buy_num}}</span>
            <button class="jia" buy_num="{{$v->buy_num}}" goods_id="{{$v->goods_id}}">＋</button>
        </td>
        <td><a href="javascript:;" class="cartDel" goods_id="{{$v->goods_id}}">删除</a></td>
    </tr>
    @endforeach
    购物车总价：<strong class="sum">0</strong>
</table>

<button id="pay"><a href="/orderList"></a>去结算</button>
</body>
</html>
<script src="js/jquery-3.1.1.min.js"></script>
<script>
    //点击减号
    $('.jian').click(function(){
        var buy_num = $(this).attr('buy_num');
        var goods_id = $(this).attr('goods_id');
        $.ajax({
            url:"cartJian",
            method:"get",
            data:{buy_num:buy_num,goods_id:goods_id},
            dataType:"JSON",
            success:function(res){
                if(res.code == 1){
                    alert(res.msg);
                }else{
                    $('#buy_num').text(res.buy_num);
                    window.location.reload();
                }
            }
        })
    })

    function total(){
        var goods_id='';
        var sum=$('.sum').html();

        $('.box').each(function (checkbox) {

            if ($(this).prop('checked') == true) {
                var total = parseInt($(this).parents('tr').find('strong').text()) + parseInt(sum);
                $('.sum').html(total);
            }
        })
    }

    //点击复选框
    $('.box').click(function(){
        total();
    })

    //点击加号
    $('.jia').click(function(){
        var buy_num = $(this).attr('buy_num');
        var goods_id = $(this).attr('goods_id');
        $.ajax({
            url:"cartJia",
            method:"get",
            data:{buy_num:buy_num,goods_id:goods_id},
            dataType:"JSON",
            success:function(res){
               if(res.code == 1){
                    alert(res.msg);
               }else{
                   $('#buy_num').text(res.buy_num);
                   window.location.reload();
               }
            }
        })
    })

    //移除购物车
    $('.cartDel').click(function(){
        var goods_id = $(this).attr('goods_id');
        $.ajax({
            url:"cartDel",
            method:"GET",
            data:{goods_id:goods_id},
            dataType:"JSON",
            success:function(res){
                if(res.code == 0){
                    alert(res.msg);
                    window.location.reload();
                }else if(res.code == 1){
                    alert(res.msg);
                }
            }
        })
    })

    //去结算
    $("#pay").click(function(){
        var goods_id = '';
        $.each($('.box:checked'), function () {
            goods_id += $(this).parents('tr').attr('goods_id') + ",";
        })

        total = $('.sum').text();
        $.ajax({
            url: "/orderInsert",
            method: "get",
            data: {goods_id: goods_id,total:total},
            dataType: "JSON",
            success: function (res) {
                if(res.code == 200){
                    window.location.href="/OrderList?order_no="+res.order_no;
                }else if(res.code ==1){
                    alert(res.msg);
                }
            }
        })
    })
</script>