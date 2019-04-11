<?php

namespace App\Http\Controllers;

use App\StaffModel;
use Illuminate\Http\Request;

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
}
