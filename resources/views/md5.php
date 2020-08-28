<?php
echo "<pre>";
var_dump(md5('123456'));
var_dump(md5(md5('123456=========123456======sbsbfjsjdbdjj=======asbdbfjdsn')));

//验值
 $salt =   getsalt();
 echo md5(md5('12343543').$salt);
    function getsalt(){
        $str = 'dfsgfajkjadnsfdjbjhasdabsfjkwejflkDFHDHJBG!@#$%##$';
        return str_shuffle($str);
        return substr($str,0,6);
    }
