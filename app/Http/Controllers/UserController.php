<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function myAccount()
    {
        $data['header_title'] = "My Account";
        if(Auth::user()->user_type == 1)
        {
            $data['admin'] = User::getSingle(Auth::user()->id);
            return view('admin.my_account', $data);
        }
        elseif(Auth::user()->user_type == 2)
        {
            $data['teacher'] = User::getSingle(Auth::user()->id);
            return view('teacher.my_account', $data);
        }
        elseif(Auth::user()->user_type == 3)
        {
            $data['student'] = User::getSingle(Auth::user()->id);
            return view('student.my_account', $data);
        }
        elseif(Auth::user()->user_type == 4)
        {
            $data['parent'] = User::getSingle(Auth::user()->id);
            return view('parent.my_account', $data);
        }
    }

    public function updateAccountAdmin(Request $request)
    {
        $admin = User::getSingle(Auth::user()->id);
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        ]);
        $admin->update($request->all());
        toastr()->addsuccess('Account Successfully Updated');
        return redirect()->route('admin.account.edit');
    }

    public function updateAccountTeacher(Request $request)
    {
        $teacher = User::getSingle(Auth::user()->id);
        request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'marital_status' => 'required|string|max:255',
            'mobile_number' => 'required|digits_between:10,15',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'work_experience' => 'required|string|max:255', 
            'qualification' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$teacher->id, 
        ]);
        $teacher->fill($request->except('profie_pic'));
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
        toastr()->addsuccess('Account Successfully Updated');
        return redirect()->route('teacher.account.edit');
    }

    public function updateAccountStudent(Request $request)
    {
        $student = User::getSingle(Auth::user()->id);
        request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_of_birth' => 'required|date',
            'caste' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'mobile_number' => 'required|digits_between:10,15',
            'blood_group' => 'required|string|max:255',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'email' => 'required|email|unique:users,email,' . $student->id, 
        ]);
        $student->fill($request->except('profie_pic'));
        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $student->profile_pic = $filename;
        }
        $student->save();
        toastr()->addsuccess('Account Successfully Updated');
        return redirect()->route('student.account.edit');
    }

    public function updateAccountParent(Request $request)
    {
        $parent = User::getSingle(Auth::user()->id);
        request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'occupation' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'profile_pic' => 'nullable|file|image|max:5024', 
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$parent->id,
        ]);
        $parent->fill($request->except('profie_pic'));
        if(!empty($request->file('profile_pic')))
        {
            if(!empty($parent->getProfile()))
            {
                unlink('upload/profile/'.$parent->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $parent->profile_pic = $filename;
        }
        $parent->save();
        toastr()->addsuccess('Account Successfully Updated');
        return redirect()->route('parent.account.edit');
    }

    public function change_passwordShow()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }
    public function change_passwordUpdate(Request $request)
    {
        $user = Auth::user();
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();

            toastr()->addsuccess('Password Updated Successfully ');
            return redirect()->back();
        }
        else
        {
            toastr()->adderror('Old Password is not correct. ');
            return redirect()->back();
        }
    }
}
