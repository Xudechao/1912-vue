<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品</title>
</head>
<body>
<table border="2" >
    <tr>
        <td>ID</td>
        <td>goods_name</td>
        <td>goods_sn</td>
        <td>click_count</td>
        <td>goods_number</td>
        <td>shop_price</td>
        <td>keywords</td>
        <td>goods_desc</td>
    </tr>
        @foreach($data as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_sn}}</td>
        <td>{{$v->click_count}}</td>
        <td>{{$v->goods_number}}</td>
        <td>{{$v->shop_price}}</td>
        <td>{{$v->keywords}}</td>
        <td>{{$v->goods_desc}}</td>
    </tr>
    @endforeach
</table>
{{$data->links()}}
</body>
</html>
