<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;

class TestController extends Controller
{
    public function brand(){
        $brand = BrandModel::all();

        echo json_encode(['code'=>'00000','msg'=>'ok','data'=>$brand]);
    }
}
