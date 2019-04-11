<?php

namespace App\Http\Controllers;

use App\UnitModel;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function unit()
    {
        $unit = UnitModel::whereis_del(0)->get();
        return view('unit.unit')->with(['unit' => $unit]);
    }
    public function insert_unit()
    {
        $unit = new UnitModel();
        $unit->unit = request('name');
        $unit->save();
        return back()->with('message', 'Unit Has Been Added Successfully:)');
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

    public function edit_unit($id)
    {
        $id = base64_decode($id);
        $edit = UnitModel::find($id);
        return view('unit.editunit')->with(['edit' => $edit]);
    }

    public function update_unit($id)
    {
        $unit = UnitModel::find($id);
        $unit->unit = request('name');
        $unit->save();
        return redirect('unit')->with('message', 'Unit Has Been Updated Successfully:)');
    }

    public function del_unit()
    {
        $did = request('did');
        $unit = UnitModel::find($did);
        $unit->is_del = 1;
        $unit->save();
        return 'done';
    }
}
