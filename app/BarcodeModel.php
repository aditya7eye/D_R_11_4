<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarcodeModel extends Model
{
  
    protected $table = 'barcode';
   public $timestamps = false;

   public function product()
   {
       return $this->belongsTo('App\Product','p_id');
   }
}
