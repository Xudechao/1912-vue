<?php

namespace App\Common\Auth;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Jwt{
    private $token;
    private $decodetoken;
    //jwt签发者
    private $iss = 'http://vue.1912.com';
    //接收jwt的一方
    private  $aud = 'api_1912_app';
    //用户id
    private $uid;
    //私钥
    private $scerect = "!@&*^%*&()&&**";
    //静态成员属性 存放实例
    private static $instance;
    private function __construct(){

    }
    private function __clone(){

    }
    public static function instance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function encode(){
        $time = time();
        $this->token = (new Builder())->setHeader('alg','HS256') // Configures the issuer (iss claim)
        ->issuedBy($this->iss)
            ->permittedFor($this->aud) // Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($time) // Configures the time that the token was issue (iat claim)
            ->canOnlyBeUsedAfter($time) // Configures the time that the token can be used (nbf claim)
            ->expiresAt($time + 300) // Configures the expiration time of the token (exp claim)
            ->withClaim('uid', $this->uid) // Configures a new claim, called "uid"
            ->sign(new Sha256(),$this->scerect)
            ->getToken(); // Retrieves the generated token
        return $this->token;
    }
    public function setuid($uid){
        $this->uid = $uid;
        return $this;
    }
    public function getToken(){
        return (string)$this->encode();
    }
    public function setToken($token){
        $this->token = $token;
        return $this;
    }
    public function decode(){
        if(!$this->decodetoken) {
            $this->decodetoken = (new Parser())->parse((string) $this->token);
            $this->uid = $this->decodetoken->getClaim('uid');

        }
        return $this->decodetoken;
    }
    public function verify(){
        $signer = new Sha256();
        $res = $this->decode()->verify($signer,$this->scerect);
        return $res;
    }
    public  function Validate(){
        $data = new ValidationData();
        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);
        $data->setId('4f1g23a12aa');
        $res = $this->decode()->validate($data);
        return $res;
    }
    public function getUid(){
        return $this->uid;
    }

}
