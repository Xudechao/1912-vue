<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\LoginModel;
use App\Common\Auth\Jwt;
use App\Http\Response\JsonRequest;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function reg()
    {
        return view('reg.reg');
    }
    public function regs(Request $request)
    {
        $admin_name = $request->post('admin_name');
        $pwd = $request->post('pwd');
        $admin = LoginModel::where(["admin_name" => $admin_name])->first();
        if ($admin) {
            $response = [
                "error" => "1231",
                "msg" => "用户名已存在"
            ];
            return $response;
        }

        if (empty($admin_name)) {
            $response = [
                "error" => "1232",
                "msg" => "用户名不能为空"
            ];
            return $response;
        }
        if (empty($pwd)) {
            $response = [
                "error" => "1233",
                "msg" => "密码不能为空"
            ];
            return $response;
        }

        $pass = password_hash($pwd, PASSWORD_BCRYPT);

        $userInfo = [
            "admin_name" => $admin_name,
            "pwd" => $pass,
        ];
        $id = LoginModel::insertGetId($userInfo);
        if ($id) {
            $uid = $id['user_id'];
            $jwt = Jwt::instance();
            $token = $jwt::instance($uid)->getToken();
            dd($token);
        }

    }

    public function shop()
    {
        $key = 'user';
        $goods = Redis::get($key);
        if (!$goods){
            echo "没缓存";
            echo '<hr>';
            $goods = GoodsModel::get()->toArray();
            $goods = serialize($goods);
            Redis::set($key,$goods);
        }else{
            $goods = Redis::set($key);
            $goods = unserialize($goods);
            echo "有缓存";
            echo "<hr>";
        }
        $keys = 'count';
        $count = Redis::incr($keys);
        Redis::expire($keys,300);
        if ($count>10){
            echo '5分钟内访问十次，超出访问次数';die;
        }
        return $this->T($goods);
    }
}
