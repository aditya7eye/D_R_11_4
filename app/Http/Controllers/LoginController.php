<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{
    function login()
    {
        return view('login');
    }

    function check_user(Request $request)
   {
      $username = request('username');
      $password = request('pass');
      $output = Admin::where(['username' => $username , 'password' => $password , 'is_del' => 0])->first();
      if (isset($output)) {
        $request->session()->put('adminmaster', $output);
        return redirect('master_dashboard');
      }
    else {
        return redirect('/')->with('message', 'Username / Password Invalid');
    }
   }
   function logout(Request $request)
    {
        $request->session()->forget('adminmaster');
        return redirect('/');
    }
}
