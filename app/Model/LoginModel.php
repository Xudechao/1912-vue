<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    public $table = 'admin';

    protected  $primaryKey = 'admin_id';

    public $timestamps = false;
}
