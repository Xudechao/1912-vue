<?php
namespace App\Common\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
/**
 * 单例模式
 * Class Jwt
 * @package App\Auth\Jwt
 */
class Jwt{
    private $token;
    //jwt验签者
    private $iss = 'http://vue.1912.com';
    //接收jwt的一方
    private $aud = 'api_1912_app';
    //用户ID
    private $uid;
    //私钥
    private $scerect = '!@#$%^&*()QWEQWE';
    //静态成员属性 存放实例
    private static $instance;
    //私有的构造函数 防止在类外进行new
    private function __construct()
    {
    }
    //私有的克隆 防止被克隆
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    public static function instance()
    {
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function encode(){
        $time = time();
        $this->token = (new Builder())->setHeader('alg','HS256')
            ->issuedBy($this->iss)
            // Configures the issuer (iss claim)
        ->permittedFor($this->aud)
            // Configures the audience (aud claim)
        ->identifiedBy('4f1g23a12aa', true)
            // Configures the id (jti claim), replicating as a header item
        ->issuedAt($time)
            // Configures the time that the token was issue (iat claim)
        ->canOnlyBeUsedAfter($time + 60)
            // Configures the time that the token can be used (nbf claim)
        ->expiresAt($time + 3600)
            // Configures the expiration time of the token (exp claim)
        ->withClaim('uid', $this->uid)
            // Configures a new claim, called "uid"
        ->sign(new Sha256(),$this->scerect)
        ->getToken();
            // Retrieves the generated token
        return $this->token;
    }

    public function setuid($uid){
        $this->uid = $uid;
        return $this;
    }

    public function getToken(){
        return (string)$this->encode();
    }
}
?>
