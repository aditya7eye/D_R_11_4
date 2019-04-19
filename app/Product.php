<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    public function b_name()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

}
