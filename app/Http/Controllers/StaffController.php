<?php

namespace App\Http\Controllers;

use App\StaffModel;
use Illuminate\Http\Request;
use App\Product;
use App\BarcodeModel;
use App\CustomerModel;

class StaffController extends Controller
{
    public function staff()
    {
        $stafflist = StaffModel::where(['is_del'=>0])->get();
        return view('staff.staff')->with(['stafflist' => $stafflist]);
    }
    public function insert_staff()
    {
        $staff = new StaffModel();
        $staff->branch_id = session('store')->id;
        $staff->username = request('username');
        $staff->password = request('password');
        $staff->name = request('name');
        $staff->contact = request('contact');
        $staff->email = request('email');
        $staff->save();
        return back()->with('message', 'Staff Has Been Added');
    }
    public function check_staff_username()
    {
        $username = request('username');
//        $data = StaffModel::whereusername($username)->whereis_del(0)->first();
        $data = StaffModel::whereusername($username)->first();
        if (isset($data)) {
            return 'Not Available';
        } else {
            return 'Available';
        }

    }

    public function edit_staff($id)
    {
        $id = base64_decode($id);
        $edit = StaffModel::find($id);
        return view('staff.editstaff')->with(['edit' => $edit]);
    }

    public function update_staff($id)
    {
        $staff = StaffModel::find($id);
        $staff->username = request('username');
        $staff->password = request('password');
        $staff->name = request('name');
        $staff->contact = request('contact');
        $staff->email = request('email');
        $staff->save();
        return redirect('staff')->with('message', 'Staff Has Been Updated');
    }

    public function del_staff()
    {
        $did = request('did');
        $staff = StaffModel::find($did);
        $staff->is_del = 1;
        $staff->save();
        return 'done';
    }

    function bar()
    {
        // $generator = new \Picqer\Barcode\BarcodeGeneratorHTML(); 
        // echo 'Atta'; 
        // echo $generator->getBarcode('12345', $generator::TYPE_CODE_39);
        // echo '00001'; 
        return view('printbarcode');
    }

    function pos()
    {
        return view('pos.pos');
    }

    public function getproducts()
    {
        $product = Product::get('name');
        return $product;
    }
    public function productdata()
    {
        $bid = session('store')->id;
        $productdata = Product::where(['name'=>request('name') , 'branch_id' => $bid])->first();
        if(isset($productdata))
        {
            $product = BarcodeModel::wherep_id($productdata->id)->first();
            return ['product'=>$product, 'productdata'=> $productdata];
        }
        else{
            return 'Product Not Found';
        }
    }
    public function getBarcodeProducts()
    {
        $branch_id = session('store')->id;
        $barcode = request('barcode');
        $product = BarcodeModel::where(['barcode'=>$barcode, 'branch_id'=>$branch_id])->first();
        if(isset($product))
        {
            $productdata = Product::where(['branch_id' => $branch_id,'id'=>$product->p_id])->first();
            return ['product'=>$product, 'productdata'=> $productdata];
        }
        else{
            return 'Product Not Found';
        }
    }
    public function mobileCheck()
    {
        $mobile = request('mobile');
        $customer = CustomerModel::where(['mobile'=>$mobile, 'is_del'=>1])->first();
        if(isset($customer))
        {
            return $customer;
        }
        else
        {            
            return 'Customer Not Found';
        }
    }
}
