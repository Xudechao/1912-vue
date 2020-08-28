<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use App\Model\LoginModel;
use App\Model\CartModel;
use App\Common\Auth\Jwt;
use App\Http\Response\JsonRequest;
use Illuminate\Support\Facades\Redis;
use App\Common\Error\ErrorInfo;
use  App\Exceptions\ApiException;
use  App\Exceptions\UidException;]

class TestController extends UidException
{
    use JsonRequest;
//    public function goods(){
//        $goods = GoodsModel::select(['goods_id','goods_name','shop_price','goods_img','goods_desc'])->get()->toArray();
//        return $this->Y($goods);
//    }

    public function reg(){

        return view('reg');
    }

    public function login(Request $request){

        $admin_name = $request->admin_name;
        $admin_pwd = $request->admin_pwd;
//        dd($admin_pwd);
        $user = LoginModel::where('admin_name',$admin_name)->first();

        if(!$user){
//            return $this->N(ErrorInfo::ERROR_USER_PWD[0],ErrorInfo::ERROR_USER_PWD[1]);

            throw new ApiException(ErrorInfo::ERROR_USER);
        }

        if(decrypt($user->pwd)!=$admin_pwd){
            throw new ApiException(ErrorInfo::ERROR_USER_PWD);
        }

        $uid = $user->id;
        $jwt = Jwt::instance();
        $token = $jwt->setuid($uid)->getToken();
        $result = $this->Y(['token'=>$token]);

        echo $result;
        dd($result);
    }
    public function usr(){
        $uid = $this->Uid();

        $logins = LoginModel::where('id',$uid)->first();
        return $this->T($logins);
    }
    public function register(Request $request){
        $name = $request->admin_name;
        $pwd = $request->pwd;
        $first = LoginModel::where('admin_name',$name)->first();
        if($first){
            throw new ApiException(ErrorInfo::FIND_USER);
        }
        $data = [
            'admin_name'=>$name,
            'pwd'=>encrypt($pwd)
        ];
        $add = LoginModel::insert($data);
        if($add){
            $uid = $first['id'];
            $jwt = Jwt::instance();
            $token = $jwt::instance($uid)->getToken();
            $result = $this->Y(['token'=>$token]);
            echo $result;
            dd($result);
        }
    }
    public function shop(){
        $key = 'user';
        $goodsdesc = Redis::get($key);
        if(!$goodsdesc){
            echo "没缓存";
            echo "<br>";
            $goodsdesc = GoodsModel::orderBy('goods_id','desc')->get()->toArray();
            $goodsdescs = serialize($goodsdesc);
            Redis::set($key,$goodsdescs);
        }else{
            $goodsdesc = Redis::get($key);
            $goodsdesc = unserialize($goodsdesc);
            echo "有缓存";
            echo "<br>";
        }
        $keys = 'count';
        $content = Redis::incr($keys);
        Redis::expire($keys,300);
        if($content>10){
            echo '5分钟内访问十次，超出访问次数';die;
        }

        return $this->T($goodsdesc);
    }

    public function getNewGoods()
    {
        $goods = GoodsModel::orderBy('goods_id','desc')->limit(5)->get();

        return $this->T($goods);
    }
    public function getMyCart()
    {
        $cart = CartModel::where('admin_id',request()->admin_id)->get();
        return $this->T($cart);
    }
}
