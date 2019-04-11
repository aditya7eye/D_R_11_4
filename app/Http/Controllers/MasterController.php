<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    function master_dashboard()
    {
        return view('master.master_dashboard');
    }
}
