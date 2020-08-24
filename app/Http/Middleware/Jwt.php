<?php

namespace App\Http\Middleware;

use Closure;
use App\Common\Auth\Jwt AS JwtToken;
use App\Common\Error\ErrorInfo;
use  App\Exceptions\ApiException;
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
            throw new ApiException(ErrorInfo::NO_TOKEN);
        }
        $jwt = JwtToken::instance();
        $jwt->setToken($token);
        if($jwt->verify()&&$jwt->Validate()){
            return $next($request);
        }
        throw new ApiException(ErrorInfo::NO_TOKEN);

    }
}
