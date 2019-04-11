<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Cat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table = 'product_cat';
    public $timestamps = false;
}
