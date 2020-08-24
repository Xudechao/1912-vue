<?php
namespace App\Common\Error;
class ErrorInfo
{
    const SUCCESS = ['00000', '请求成功'];
    const ERROR = ['11111','请求失败'];
    const ERROR_USER = ['10001','没有此用户'];
    const ERROR_USER_PWD = ['10005','用户名或者密码错误'];
    const  FIND_USER = ['10002','此用户已存在'];
    const  NULL_All = ['10003','任意选项非空'];
    const ERROR_PWD =['10004','两次密码不一致'];
    const NO_TOKEN =['20001','TOKEN缺失或错误'];

}
