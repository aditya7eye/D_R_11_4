<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreMasterController extends Controller
{
    function store_dashboard(){
        return view('storemaster.dashboard');
    }
}
