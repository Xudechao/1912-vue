<?php

namespace App\Http\Middleware;

use Closure;
use App\Common\Auth\Jwt AS JwtToken;
class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->token;
        if(!$token){
            echo json_encode(['error_no'=>'10003','error_msg'=>'参数缺失']);die;
        }
        $jwt = JwtToken::instance();
        $jwt->setToken($token);
        if($jwt->verify()&&$jwt->Validate()){
            return $next($request);
        }
        echo json_encode(['error_no'=>'10002','msg'=>'token参数无效']);die;

    }
}
