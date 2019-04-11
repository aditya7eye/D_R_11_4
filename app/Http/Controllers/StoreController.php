<?php

namespace App\Http\Controllers;

use App\Store;

class StoreController extends Controller
{
    public function store()
    {
        $storelist = store::whereis_del(0)->get();
        return view('store.store')->with(['storelist' => $storelist]);
    }
    public function insert_store()
    {
        $store = new Store();
        $store->name = request('name');
        $store->location = request('location');
        $store->username = request('username');
        $store->password = request('password');
        $store->save();
        return back()->with('message', 'Store Has Been Added');
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

    public function edit_store($id)
    {
        $id = base64_decode($id);
        $edit = Store::find($id);
        return view('store.editstore')->with(['edit' => $edit]);
    }

    public function update_store($id)
    {
        $store = Store::find($id);
        $store->name = request('name');
        $store->location = request('location');
        // $store->username = request('username');
        $store->password = request('password');
        $store->save();
        return redirect('store')->with('message', 'Store Has Been Updated');
    }

    public function del_store()
    {
        $did = request('did');
        $store = Store::find($did);
        $store->is_del = 1;
        $store->save();
       return 'done';
    }

}
