<?php

namespace App\Http\Response;

trait JsonRequest{
    public function Y($data){
        return $this->All('000000','成功',$data);
    }
    public function T($data){
        return $this->All('0','ok',$data);
    }
    public function N($error_no,$error_msg){
        return $this->All($error_no,$error_msg);
    }
    public function All($error_no,$error_msg,$data=[]){
        $content = [
            'error_no'=>$error_no,
            'error_msg'=>$error_msg,
            'data'=>$data
        ];
        return  json_encode($content);die;

//        echo json_encode($content);die;
    }
}
