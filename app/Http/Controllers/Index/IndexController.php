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
    {	    {
        $user_name = \request()->input('user_name');	        $admin_name = $request->post('admin_name');
        $user_pwd = \request()->input('user_pwd');	        $pwd = $request->post('pwd');
        $email = \request()->input('email');	        $admin = LoginModel::where(["admin_name" => $admin_name])->first();

        if ($admin) {
            if (empty($user_name)){	            $response = [
            echo json_encode(['code'=>'100001','msg'=>'用户名不能为空']);die;	                "error" => "1231",
                "msg" => "用户名已存在"
            ];
            return $response;
        }	        }
        if (empty($user_pwd)){
            echo json_encode(['code'=>'100002','msg'=>'密码不能为空']);die;	        if (empty($admin_name)) {
                $response = [
                    "error" => "1232",
                    "msg" => "用户名不能为空"
                ];
                return $response;
            }	        }
        if (empty($email)){	        if (empty($pwd)) {
            echo json_encode(['code'=>'100003','msg'=>'邮箱不能为空']);die;	            $response = [
                "error" => "1233",
                "msg" => "密码不能为空"
            ];
            return $response;
        }	        }


        $data = [	        $pass = password_hash($pwd, PASSWORD_BCRYPT);
        'user_name' => $user_name,
            'user_pwd' =>$user_pwd
        ];


        $res = AdminModel::insert($data);	        $userInfo = [
        if ($res){	            "admin_name" => $admin_name,
            return view('Http://vue.1912.com/api/admin/add');	            "pwd" => $pass,
        ];
        $id = LoginModel::insertGetId($userInfo);
        if ($id) {
            $uid = $id['user_id'];
            $jwt = Jwt::instance();
            $token = $jwt::instance($uid)->getToken();
            dd($token);
        }	        }


    }	    }

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
}	}
