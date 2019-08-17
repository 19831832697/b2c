<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加sku</title>
</head>
<body>
<form action="/admin/skuInsert" method="post">
    <input type="hidden" name="goods_id" value="{{$goodsInfo->goods_id}}">
    <table>
        <tr>
            <td>商品名称：</td>
            <td><input type="text" name="goods_name" value="{{$goodsInfo->goods_name}}"></td>
        </tr>
        <tr>
            <td>商品货号：</td>
            <td><input type="text" name="goods_sn" value="{{$goodsInfo->goods_sn}}"></td>
        </tr>
        <tr>
            <td>商品属性：</td>
            <td><input type="text" name="sku"></td>
        </tr>
        <tr>
            <td>属性价格：</td>
            <td><input type="text" name="price"></td>
        </tr>
        <tr>
            <td>商品售价</td>
            <td><input type="text" name="price0"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
            <td></td>
        </tr>
    </table>

</form>

</body>
</html>