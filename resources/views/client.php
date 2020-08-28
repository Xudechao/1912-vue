<?php
//http://1912.api.com/server?time=1598533241&appid=wx0a0d276f71eea575&name=zhangsan&signatureeb9a8db77b428af7162ab0107938279b
define('TOKEN','wechat');
$url = "http://1912.api.com/server?";

$paeams["time"] = time();
$paeams["appid"] = "wx0a0d276f71eea575";
$paeams["name"] = 'zhangsan';

$querystring = http_build_query($paeams);
//echo $querystring;

$sign = getSign($paeams);
//echo $sign;
$querystring.='&signature'.$sign;
//echo $querystring;
$url.=$querystring;
echo $url;

function getSign($paeams){

    $paeams['token'] = TOKEN;
    echo "<pre>";
    var_dump($paeams);die;
    sort($paeams);
    $querystring = http_build_query($paeams);
    return md5($querystring);


}

