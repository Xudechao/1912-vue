<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;

class IndexController extends Controller
{
    public function reg()
    {
        return view('reg.reg');
    }
    public function regs()
    {
        $user_name = \request()->input('user_name');
        $user_pwd = \request()->input('user_pwd');
        $email = \request()->input('email');

        if (empty($user_name)){
            echo json_encode(['code'=>'100001','msg'=>'用户名不能为空']);die;
        }
        if (empty($user_pwd)){
            echo json_encode(['code'=>'100002','msg'=>'密码不能为空']);die;
        }
        if (empty($email)){
            echo json_encode(['code'=>'100003','msg'=>'邮箱不能为空']);die;
        }

        $data = [
            'user_name' => $user_name,
            'user_pwd' =>$user_pwd
        ];

        $res = AdminModel::insert($data);
        if ($res){
            return view('Http://vue.1912.com/api/admin/add');
        }

    }
}
