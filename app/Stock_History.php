<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_History extends Model
{
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_history';
   public $timestamps = false;
}
