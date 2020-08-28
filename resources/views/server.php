<?php
define('TOKEN','wechat');

$paeams = $_GET;
echo "<pre>";
//var_dump($paeams);

$sign = getSign($paeams);
if ($paeams['signature']!=$sign){
    echo "签名错误";
}else{
    echo "OK";
}

function getSign($paeams){

    $paeams['token'] = TOKEN;
//    unset($paeams['signature']);
    var_dump($paeams);die;
    sort($paeams);
    $querystring = http_build_query($paeams);
    return md5($querystring);


}
