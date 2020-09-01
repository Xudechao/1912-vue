<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    //注册
    public function reg(Request $request)
    {
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $user_pwd = $request->input('user_pwd');
        $user_pwds = $request->input('user_pwds');

       $user = AdminModel::where(["user_name"=>$user_name])->first();
        if ($user){
            $response = [
                "error" => "1231",
                "msg" => "用户名已存在"
            ];
            return $response;
        }
        if (empty($user_name)) {
            $response = [
                "error" => "1232",
                "msg" => "用户名不能为空"
            ];
            return $response;
        }
        if (empty($email)) {
            $response = [
                "error" => "1233",
                "msg" => "邮箱不能为空"
            ];
            return $response;
        }
        if (empty($user_pwd)) {
            $response = [
                "error" => "1234",
                "msg" => "密码不能为空"
            ];
            return $response;
        }
        if (empty($user_pwds)) {
            $response = [
                "error" => "1235",
                "msg" => "确认密码不能为空"
            ];
            return $response;
        }
        $pass = password_hash($user_pwd, PASSWORD_BCRYPT);

        $userInfo = [
            "user_name" => $user_name,
            "email" => $email,
            "user_pwd" => $pass,
            "reg_time" => time()
        ];
        $usr = AdminModel::insertGetId($userInfo);

        if ($usr){
            $response = [
                "error" => "0",
                "msg" => "ok"
            ];
            return $response;
        }

    }

    //登录
    public function login(Request $request)
    {
        $user_name = $request->input('user_name');
        $user_pwd = $request->input('user_pwd');

        if (empty($user_pwd)) {
            $response = [
                "error" => "1234",
                "msg" => "密码不能为空"
            ];
            return $response;
        }
        $pass = password_verify($user_pwd, PASSWORD_BCRYPT);;
        $token = Str::random(32);
        $login = AdminModel::where(['user_name'=>$user_name,"user_pwd"=>$pass])->first();
        if ($login){
            $response = [
                "error" => "1231",
                "msg" => "登录成功",
                'data' => [
                    'token' => $token
                ]
            ];
        }else{
            $response = [
                "error" => "1236",
                "msg" => "用户不存在",
            ];
        }
        return $response;
    }

    //列表
    public function goods()
    {
        $data = DB::table('p_goods')->paginate(8);
        return view('api.goods',['data'=>$data]);
    }

//    public function api()
//    {
//        $key = 'a52cd0e612ff43f38f68bc0042cd0eab';
//        $url = 'http://api.avatardata.cn/Account/Info?key='.$key;
//        $cont = file_get_contents($url);
//        echo $cont;
//    }

    public function api2()
    {
//        $key = "a52cd0e612ff43f38f68bc0042cd0eab";
        $keyword = ['赵子龙','赵洪耀','赵雨婷','赵硕','赵英帅','赵毅','赵丽颖'];
        $dataurl = [];
        foreach ($keyword as $v){
            $dataurl[] = 'http://api.avatardata.cn/ActNews/Query?key=708e5f69b44d418685da4cbb0007c093&keyword='.$v;
        }

        foreach ($dataurl as $v){
            $data = $this->curl($v);
            dd($data);die;

            $data = json_decode($data,true);

        }
//
//
//        //创建一个新的curl资源
//        $ch = curl_init();
//
//        //设置URL和相应的选项
//        curl_setopt($ch,CURLOPT_URL,$url);
//        curl_setopt($ch,CURLOPT_HEADER,0);
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//
//        //获取URL并把他传递到浏览器
//        $response = curl_exec($ch);
//
//        //关闭curl资源
//        curl_close($ch);
//
//        echo $response;

    }


}
