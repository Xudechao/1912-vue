<?php
function checkToken($token){
    if ($token!=='1912'){
        throw new Exception('token无效');
    }
    return true;
}

try{
    checkToken('1911');
} catch (Exception $e){
    echo $e->getMessage().PHP_EOL;
    echo $e->getCode().PHP_EOL;
    echo $e->getFile().PHP_EOL;
    echo $e->getLine().PHP_EOL;
}
