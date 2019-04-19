<?php

namespace App\Http\Controllers;

use App\BarcodeModel;

class BarcodeController extends Controller
{
    public function barcode()
    {
        $branch = session('store')->id;
        $barcode = BarcodeModel::wherebranch_id($branch)->orderBy('id','desc')->get();
        return view('barcode.barcode')->with(['barcode' => $barcode]);
    }
}
