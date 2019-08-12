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
        <td>订单号</td>
        <td>{{$order_no}}</td>
    </tr>
{{--    @foreach($arr as $v)--}}
    <tr>
        <td>商品名称</td>
{{--        <td>{{$arr['goods_name']}}</td>--}}
    </tr>
    {{--@endforeach--}}
    <tr>
        <td>商品总价</td>
{{--        <td>{{$arr->order_amount}}</td>--}}
    </tr>
</table>
<button><a href="/z_pay?order_no={{$order_no}}">立即支付</a></button>
</body>
</html>
