<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use App\Common\Auth\Jwt;
class UidException extends Controller
{

    public function Uid(){
        $jwt = Jwt::instance();
        $uid = $jwt->getUid();
        return $uid;
    }
}
