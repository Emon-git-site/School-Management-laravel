<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Admin List';
        $data['admins'] = User::getAdmin();
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add new Admin';
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = User::make($request->except('password'));
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        toastr()->addsuccess('Admin Successfully Created');
        return redirect()->route('admin.admin.list');
    }

    public function edit($id)
    {
        $data['admin'] = User::where('user_type', 1)->where('id', $id)->first();
        if(!empty($data['admin']))
        {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        }
        else
        {
            abort(404);
        }
    }
    public function update(Request $request ,User $admin)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$admin->id
        ]);

        $admin->fill($request->except('password'));
        $admin->password = Hash::make($request->password);
        $admin->update();

        toastr()->addsuccess('Admin  Information Updated Successfully ');
        return redirect()->route('admin.admin.list');
    }

    public function destroy(User $admin)
    {
        $admin->is_delete = 1;
        $admin->save();
        toastr()->addsuccess('Admin Successfully Deleted');
        return redirect()->route('admin.admin.list');
    }
}
