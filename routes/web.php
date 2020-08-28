<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//
Route::view("/getdata","getdata");

Route::any('/admin/reg','Index\IndexController@reg'); //注册
Route::any('/admin/regs','Index\IndexController@regs');

Route::view("/login","login");
route::view('/register','register');

Route::any('/test','Test\TestController@test');
Route::any('/tets','Test\TestController@tets');
Route::any('/md5','Test\TestController@md5');
Route::any('/client','Test\TestController@client');
Route::any('/server','Test\TestController@server');
