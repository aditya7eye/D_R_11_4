<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Product_Cat;
use App\Stock_History;
use App\Unit;
use App\Vendor;
use PDF;
use Illuminate\Http\Request;
use App\BarcodeModel;

class ProductController extends Controller
{
    public function products()
    {
        $brand = Brand::whereis_del(0)->get();
        $unit = Unit::whereis_del(0)->get();
        $vendor = Vendor::whereis_del(0)->get();
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        return view('products.products')->with(['brand' => $brand, 'unit' => $unit, 'catlist' => $catlist, 'vendor' => $vendor]);
    }

    public function insert_products(Request $request)
    {

        $pro = new Product();
        $pro->branch_id = session('store')->id;
        $pro->brand_id = request('brand');
        $pro->name = request('p_name');
        $pro->cost_price = request('cost_price');
        $pro->selling_price = request('selling_price');
        $pro->lose_pack = request('loose_pack');
        $pro->gst = request('gst');
        $pro->cgst = request('cgst');
        $pro->sgst = request('sgst');
        $pro->stock = request('qty') + request('f_qty');
        $pro->unit_id = request('unit');
        $data = request('myimage');
        if (request('myimage') != "") {
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = time() . '.png';
            $path = "product_image/" . $image_name;
            file_put_contents($path, $data);
            $pro->image = $image_name;
        }
        $pro->save();


        $catid = request('catid');
        foreach ($catid as $obj) {
            $cat = new Product_Cat();
            $cat->product_id = $pro->id;
            $cat->c_id = $obj;
            $cat->save();
        }

        $stock = new Stock_History();
        $stock->branch_id = session('store')->id;
        $stock->vendor_id = request('vendor');
        $stock->p_id = $pro->id;
        $stock->qty = request('qty') + request('f_qty');
        $stock->save();

        $barcode = new BarcodeModel();
        $barcode->p_id = $pro->id;
        $barcode->branch_id = session('store')->id;
        $barcode->qty = request('qty') + request('f_qty');
        $barcode->cp = request('cost_price');
        $barcode->sp = request('selling_price');
        $barcode->barcode = request('barcode');
        $barcode->pdf = request('p_name').'_'.time().'.pdf';
        $barcode->save();


        // $_SESSION['cert_id'] = $barcode->id;
        $request->session()->put('bar_id', $barcode->id);

         $data = ['Ashish'];
        // $pdf = PDF::loadView('printbarcode', $data);
        //  return  $pdf->stream();
          $pdfname = $barcode->pdf;
          PDF::loadView('printbarcode')->setPaper('a4')->save('allbarcode/'.$pdfname);
          return back()->with('message', 'Product Has Been Saved');

    }

    public function purchase()
    {
        $brand = Brand::whereis_del(0)->get();
        $unit = Unit::whereis_del(0)->get();
        $vendor = Vendor::whereis_del(0)->get();
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        return view('purchase.purchase')->with(['brand' => $brand, 'unit' => $unit, 'catlist' => $catlist, 'vendor' => $vendor]);
    }

    public function addpurchase()
    {
        return $_REQUEST;
    }

    public function addnewrow()
    {
        $uid = request('uid');
        $brand = Brand::whereis_del(0)->get();
        $unit = Unit::whereis_del(0)->get();
        $vendor = Vendor::whereis_del(0)->get();
        $catlist = Category::whereis_del(0)->whereparent_id(0)->orderBy('id', 'desc')->get();
        return view('addrow')->with(['brand' => $brand, 'unit' => $unit, 'catlist' => $catlist, 'vendor' => $vendor, 'uid' => $uid]);
    }

    public function findsuggetion()
    {
        $p_name = request('p_name');
        $result = Product::where('name', $p_name)->orWhere('name', 'like', '%' . $p_name . '%')->get();
        return $result;
    }

    public function getallrecord()
    {
        $pid = request('pid');
        $branchid = session('store')->id;
        $data = Product::where(['id' => $pid, 'branch_id' => $branchid, 'is_del' => 0])->first();
        return $data;

    }

    public function bar()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        echo 'Aditya';
        echo $generator->getBarcode('12345', $generator::TYPE_CODE_39);
        echo '00001';
    }

}
