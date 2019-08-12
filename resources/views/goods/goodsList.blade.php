<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border = 1>
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品描述</td>
        <td>操作</td>
    </tr>
        <tr>
            <td>{{$data['goods_id']}}</td>
            <td>{{$data['goods_name']}}</td>
            <td>{{$data['goods_price']}}</td>
            <td>{{$data['goods_desc']}}</td>
            <td>
                <a href="javascript:;" class="addCart" id="{{$data['goods_id']}}">加入购物车</a>
                {{--<a href="/cartList" class="cartList">查看我的购物车</a>--}}
            </td>
        </tr>
</table>
<button class="cartList"><a href="/cartList">我的购物车</a></button>
</body>
</html>
<script src="js/jquery-3.1.1.min.js"></script>
<script>
    $('.cartList').click(function(){
        $.ajax({
            url:"/cartList",
            method:"get",
            dataType:"JSON",
            success:function(res){
                if(res.code == 1){
                    alert(res.msg);
                    window.location.href="/login";
                }
            }
        })
    })
    //加入购物车
    $('.addCart').click(function(){
        var goods_id = $(this).attr('id');
        $.ajax({
            url:"/addCart",
            method:"get",
            data:{goods_id:goods_id},
            dataType:"json",
            success:function(res){
                if(res.code == 0){
                    alert(res.msg);
                }else if(res.code == 1){
                    alert(res.msg);
                }else if(res.code ==2){
                    alert(res.msg);
                    window.location.href="/login";
                }
            }
        })
    })
</script>