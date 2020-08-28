<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    public $table = 'P_category';

    protected  $primaryKey = 'user_id';

    public $timestamps = false;
}
