<?php

namespace App\Http\Controllers;

use App\BrandModel;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brand()
    {
        $brand = BrandModel::whereis_del(0)->get();
        return view('brand.brand')->with(['brand' => $brand]);
    }
    public function insert_brand()
    {
        $brand = new BrandModel();
        $brand->name = request('name');
        $brand->save();
        return back()->with('message', 'Brand Has Been Added Successfully:)');
    }
    public function check_store_username()
    {
        $username = request('username');
        $data = Store::whereusername($username)->whereis_del(0)->first();
        if (isset($data)) {
            return 'Not Available';
        } else {
            return 'Available';
        }

    }

    public function edit_brand($id)
    {
        $id = base64_decode($id);
        $edit = BrandModel::find($id);
        return view('brand.editbrand')->with(['edit' => $edit]);
    }

    public function update_brand($id)
    {
        $brand = BrandModel::find($id);
        $brand->name = request('name');
        $brand->save();
        return redirect('brand')->with('message', 'Brand Has Been Updated Successfully:)');
    }

    public function del_brand()
    {
        $did = request('did');
        $brand = BrandModel::find($did);
        $brand->is_del = 1;
        $brand->save();
        return 'done';
    }
}
