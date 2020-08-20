<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('geturlparam',function (){
    dump($_GET);
    dd(\request()->input());

});
Route::get('getformpost',function (){
    dump($_POST);
});
Route::post('upload',function (){
    dump($_POST);
    dump($_FILES);
    dump(\request()->all());
    if (\request()->hasFile('head')){
        $path = upload('head');
        dd($path);
    }
});
Route::post('getjson',function (){
    dump($_POST);
    dump(\request()->all());
    $data = file_get_contents('php://input');
    dump($data);
});

Route::get('/brand','Api\TestController@brand');
Route::any('/user/login','Api\TestController@login');
