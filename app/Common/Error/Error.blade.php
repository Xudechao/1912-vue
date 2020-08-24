<?php
namespace App\Common\Error;
//
use App\User;

/**
     * 定义全局错误信息
     * Class ErrorInfo
     * @package App\Common\Error
     */
    class ErrorInfo
    {
        const SUCCESS = ['0110','请求成功'];
        const UNKNOWM = ['0111','发生未知错误，请联系管理员'];

        // 用户信息接口常用
        // const NO_USER = ['00000','请求成功'];
        const NO_USER = ['10001','没有此用户'];
        const NO_USER_PWD = ['10002','用户名或密码错误'];
        //TOKEN接口常用
        const NO_TOKEN_PARAMS = ['20001','参数无效，缺少token'];
        const NO_TOKEN_INVALID = ['20002','token无效'];

    }
