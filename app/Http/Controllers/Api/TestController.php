<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
use App\Model\LoginModel;
use App\Common\Auth\Jwt;
use App\Http\Response\JsonRequest;

class TestController extends Controller
{
    public function brand()
    {
        $brand = BrandModel::all();

        echo json_encode(['code'=>'00000','msg'=>'ok','data'=>$brand]);
    }

    public function login(Request $request)
    {
        $admin_name = $request->admin_name;
        $pwd = $request->pwd;

       $login = LoginModel::where('admin_name',$admin_name)->first();
       //没有此用户
       if(!$login){
           echo json_encode(['code'=>'10001','msg'=>'用户名或密码错误']);die;
       }
       //密码错误
       if(decrypt($login->pwd) != $pwd){
           echo json_encode(['code'=>'10001','msg'=>'用户名或密码错误']);die;
       }

       $uid = $login->admin_id;
       //生成token
       $jwd = Jwt::instance();
       $token = $jwd::instance($uid)->getToken();
       dd($token);


    }

    public function user(){
        $user = LoginModel::get()->toArray();
        echo json_encode(['code'=>'00000','msg'=>'ok','data'=>$user]);die;

    }
}
