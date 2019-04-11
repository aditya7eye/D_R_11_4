<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Route;
class Helpme extends Model
{
    public static function isActiveRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}
