<?php

// 1
//$methods = openssl_get_cipher_methods();
//echo "<pre>";
//var_dump($methods);

//2
    $method = 'aes-128-cfb1';
    $str = "l Love PHP";
    $key = '1912php';
    $content = openssl_encrypt($str,$method,$key,OPENSSL_RAW_DATA,'1233211112332111');
    var_dump($content);
    echo "<pre>";
    $content = openssl_decrypt($content,$method,$key,OPENSSL_RAW_DATA,'1233211112332111');
    var_dump($content);


