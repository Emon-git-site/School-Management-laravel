<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function list()
    { 
        $data['header_title'] = 'Teacher List';
        $data['teachers'] = User::getTeacher();
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Teacher';
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'marital_status' => 'required|string|max:255',
            'mobile_number' => 'required|digits_between:10,15',
            'admission_date' => 'required|date',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'work_experience' => 'required|string|max:255', 
            'qualification' => 'required|string|max:255',
            'note' => 'required|string|max:1000',
            'status' => 'required',
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|string|min:6|max:255',
        ]);
        $teacher = User::make($request->except('password', 'profie_pic', 'user_type'));
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $teacher->profile_pic = $filename;
        }
        $teacher->save();
        toastr()->addsuccess('Teacher Successfully Created');
        return redirect()->route('admin.teacher.list');
    }

    public function edit(User $teacher)
    {
        $data['teacher'] = $teacher;
        if(!empty($data['teacher']))
        {
            $data['header_title'] = 'Edit Teacher';
            return view('admin.teacher.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request, User $teacher)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'marital_status' => 'required|string|max:255',
            'mobile_number' => 'required|digits_between:10,15',
            'admission_date' => 'required|date',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'work_experience' => 'required|string|max:255', 
            'qualification' => 'required|string|max:255',
            'note' => 'required|string|max:1000',
            'status' => 'required',
            'email' => 'required|email|unique:users,email,'.$teacher->id, 
            'password' => 'string|min:6|max:255',
        ]);
        $teacher->fill($request->except('password', 'profie_pic'));
        if(!empty($teacher->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        if(!empty($request->file('profile_pic')))
        {
            if(!empty($teacher->getProfile()))
            {
                unlink('upload/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $teacher->profile_pic = $filename;
        }
        $teacher->save();
        toastr()->addsuccess('Teacher Successfully Updated');
        return redirect()->route('admin.teacher.list');
    }

    public function destroy(User $teacher)
    {
        $teacher->is_delete = 1;
        $teacher->save();
        toastr()->addsuccess('Teacher Successfully Deleted');
        return redirect()->route('admin.teacher.list');
    }
}
