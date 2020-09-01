<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function api(){
        $keywords = ["奥迪","比奥迪","兰博基尼","奥布了"];
        $url = [];
        foreach ($keywords as $v) {
            $url = " http://api.avatardata.cn/ActNews/Query?key=708e5f69b44d418685da4cbb0007c093&keyword=".$v;
        }
        var_dump($url);die;
        foreach ($url as $v){
            $data = $this->curl($v);
            dd($data);die;

            $data = json_decode($data,true);

        }

    }

    public function reg()
    {
        $user_name = \request()->input('user_name');
        $user_pwd = \request()->input('user_pwd');
        $email = \request()->input('email');
        $user_pwdr = \request()->input('user_pwdr');

        $user = AdminModel::where(["user_name" => $user_name])->first();
        if ($user) {
            $response = [
                'ass' => '11210',
                'msg' => '已有此用户'
            ];
            return $response;
        }
        if (!$user_name) {
            $response = [
                'ass' => '11211',
                'msg' => '用户名不能为空'
            ];
            return $response;
        }
        if (!$user_pwd) {
            $response = [
                'ass' => '11212',
                'msg' => '密码不能为空'
            ];
            return $response;
        }
        if (!$email) {
            $response = [
                'ass' => '11213',
                'msg' => '邮箱不能为空'
            ];
            return $response;
        }
        if (!$user_pwdr) {
            $response = [
                'ass' => '11214',
                'msg' => '确认密码不能为空'
            ];
            return $response;
        }
        $pass = password_hash($user_pwd, PASSWORD_DEFAULT);

        $userInfo = [
            "user_name" => $user_name,
            "email" => $email,
            "user_pwd" => $pass,
            "reg_time" => time()
        ];
        $u = AdminModel::insertGetId($userInfo);
        if ($u) {
            $response = [
                'ass' => '00000',
                'msg' => '注册成功'
            ];
            return $response;
        }
    }

    public function login(Request $request)
    {
        $user_name = $request->input("user_name");
        $user_pwd = $request->input("user_pwd");

        $user = AdminModel::where(["user_name" => $user_name])->first();
        if (!$user_pwd) {
            $response = [
                'ass' => '11212',
                'msg' => '密码不能为空'
            ];
            return $response;
        }
        $pass = password_verify($user_pwd, PASSWORD_BCRYPT);
        $login = AdminModel::where(['user_name' => $user_name, "user_pwd" => $pass])->first();
        if ($login) {
            $response = [
                "error" => "00000",
                "msg" => "登录成功",
            ];
        } else {
            $response = [
                "error" => "11215",
                "msg" => "用户不存在",
            ];
        }
        return $response;
    }

    public function goods()
    {
        $data = DB::table("p_goods")->paginate(10);
        return view('api.goods',['data'=>$data]);
    }

}
