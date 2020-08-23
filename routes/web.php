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

Route::view("/login","login");

Route::any('/admin/reg','Index\IndexController@reg'); //注册
Route::any('/admin/regs','Index\IndexController@regs'); //登录
