<?php
$publickey = file_get_contents(storage_path("keys/pub.key"));
$privatekey = file_get_contents(storage_path("keys/priv.key"));

$data = "你想干啥";
//    私+公-
//$res = openssl_private_encrypt($data,$encdata,$privatekey);
//echo "<pre>";
//var_dump($res);
//var_dump($encdata);
//
//$res = openssl_public_decrypt($encdata,$decdata,$publickey);
//var_dump($res);
//var_dump($decdata);

//    公+私-
$res = openssl_public_encrypt($data,$encdata,$publickey);
echo "<pre>";
var_dump($res);
$encdata = base64_encode($encdata);
var_dump($encdata);

$res = openssl_private_decrypt(base64_decode($encdata),$decdata,$privatekey);
var_dump($res);
var_dump($decdata);

class Rsa{
    public function getPrivate($data)
    {
        return file_get_contents(storage_path("keys/priv.key"));
    }
    public function getpubate($data)
    {
        return file_get_contents(storage_path("keys/pub.key"));
    }

    public function privateEncrypt($data)
    {
        if (!$data){
            return null;
        }
        $privatekey = $this->getPrivate($data);
        openssl_private_encrypt($data,$encdata,$privatekey);
        return base64_encode($encdata);
    }

    public function publicDecrypr($data)
    {
        if (!$data){
            return null;
        }
        $pubatekey = $this->getpubate($data);
        openssl_public_decrypt(base64_decode($data),$decdata,$pubatekey);
        return $decdata;
    }
    public function publicEncrypt($data)
    {
        if (!$data){
            return null;
        }
        $pubatekey = $this->getpubate($data);
        openssl_public_encrypt($data,$encdata,$pubatekey);
        return base64_encode($encdata);
    }
    public function privateDecrypr($data)
    {
        if (!$data){
            return null;
        }
        $privatekey = $this->getpubate($data);
        openssl_private_decrypt(base64_decode($data),$decdata,$privatekey);
        return $decdata;
    }
}

$data = "helloword";
$rsa = new Rsa();
$encdata = $rsa->privateEncrypt($data);
echo "<pre>";
var_dump($encdata);
$$decdata = $rsa->publicDecrypr($encdata);
echo "<pre>";
var_dump($decdata);
