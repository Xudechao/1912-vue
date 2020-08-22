<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    public $table = 'user';
    public $primaryKey = 'user_id';
    public $timestamps =false;
}
