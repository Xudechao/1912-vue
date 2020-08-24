<?php

namespace App\Http\Response;

trait JsonRequest{
    public function N($error_no,$error_msg){
//        return $this->JsonResponse('000000','success',$data);

        $content = [
            'error_no'=>$error_no,
            'error_msg'=>$error_msg,
        ];
        return json_encode($content);
    }
    public function Y($data){
//        return $this->JsonResponse('000000','success',$data);

        $content = [
            'error_no'=>0,
            'error_msg'=>'ok',
            'data'=>$data
        ];
        return json_encode($content);exit;
    }
    public function CenterJson($error_no,$error_msg,$data=[]){

        $content = [
            'error_no'=>$error_no,
            'error_msg'=>$error_msg,
            'data'=>$data
        ];
        return json_encode($content);exit;
    }
}
