<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    public $table = 'brand';

    protected  $primaryKey = 'brand_id';

    public $timestamps = false;
}
