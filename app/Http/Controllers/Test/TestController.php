<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }
    public function tets()
    {
        return view('tets');
    }
    public function md5()
    {
        return view('md5');
    }
    public function client()
    {
        return view('client');
    }
    public function server()
    {
        return view('server');
    }
}
