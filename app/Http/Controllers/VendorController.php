<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\VendorModel;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendor()
    {
        $vendorlist = VendorModel::whereis_del(0)->get();
        return view('vendor.vendor')->with(['vendorlist' => $vendorlist]);
    }
    public function insert_vendor()
    {
        $vendor = new VendorModel();
        $vendor->name = request('name');
        $vendor->contact = request('contact');
        $vendor->gst_no = request('gst_no');
        $vendor->igst = request('igst');
        $vendor->sgst = request('sgst');
        $vendor->cgst = request('cgst');
        $vendor->save();
        return back()->with('message', 'Vendor Has Been Added Successfully:)');
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

    public function edit_vendor($id)
    {
        $id = base64_decode($id);
        $edit = VendorModel::find($id);
        return view('vendor.editvendor')->with(['edit' => $edit]);
    }

    public function update_vendor($id)
    {
        $vendor = VendorModel::find($id);
        $vendor->name = request('name');
        $vendor->contact = request('contact');
        $vendor->gst_no = request('gst_no');
        $vendor->igst = request('igst');
        $vendor->sgst = request('sgst');
        $vendor->cgst = request('cgst');
        $vendor->save();
        return redirect('vendor')->with('message', 'Vendor Information Has Been Updated Successfully:)');
    }

    public function del_vendor()
    {
        $did = request('did');
        $vendor = VendorModel::find($did);
        $vendor->is_del = 1;
        $vendor->save();
        return 'done';
    }
}
