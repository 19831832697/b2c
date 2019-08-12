<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品列表</title>
</head>
<body>
<h1>商品列表</h1>
<table border = 1>
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>操作</td>
    </tr>
    @foreach($arr as $v)
    <tr>
        <td>{{$v['goods_id']}}</td>
        <td>{{$v['goods_name']}}</td>
        <td>{{$v['goods_price']}}</td>
        <td>
            <a href="/goodsDetail?goods_id={{$v['goods_id']}}">查看商品详情</a>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>
<script src="js/jquery-3.1.1.min.js"></script>
