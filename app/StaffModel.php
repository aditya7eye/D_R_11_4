<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo('\App\Store', 'branch_id');
    }
}
