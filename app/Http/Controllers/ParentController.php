<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Parent List';
        $data['parents'] = User::getParent();
        return view('admin.parent.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Parent';
        return view('admin.parent.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'occupation' => 'max:100',
            'name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
            // do more validation later
        ]);
        $parent = User::make($request->except('password', 'profie_pic'));
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $parent->profile_pic = $filename;
        }
        $parent->save();
        toastr()->addsuccess('Parent Successfully Created');
        return redirect()->route('admin.parent.list');
    }

    public function edit(User $parent)
    {
        $data['parent'] = $parent;
        if (!empty($data['parent'])) {
            $data['header_title'] = 'Edit parent';
            return view('admin.parent.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, User $parent)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $parent->id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            // do more validation later
        ]);
        $parent->fill($request->except('password', 'profie_pic'));
        if (!empty($parent->password)) {
            $parent->password = Hash::make($request->password);
        }
        if (!empty($request->file('profile_pic'))) {
            if (!empty($parent->getProfile())) {
                unlink('upload/profile/' . $parent->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $parent->profile_pic = $filename;
        }
        $parent->save();
        toastr()->addsuccess('parent Successfully Updated');
        return redirect()->route('admin.parent.list');
    }

    public function destroy(User $parent)
    {
        $parent->is_delete = 1;
        $parent->save();
        toastr()->addsuccess('Parent Successfully Deleted');
        return redirect()->route('admin.parent.list');
    }

    public function myStudent(User $parent)
    {
        $data['singleParent'] = $parent;
        $data['parent_id']= $parent->id;
        $data['header_title'] = 'Parent Student List';
        $data['getSearchStudents'] = User::getSearchStudent();
        $data['getParentStudents'] = User::getParentStudent($parent->id);
        return view('admin.parent.my_student', $data);
    }

    public function assignStudentParent( $student_id,  $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        toastr()->addsuccess('Student Successfully Assign');
        return redirect()->back();
    }

    public function assignStudentParentDelete($student_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = null ;
        $student->save();
        toastr()->addsuccess('Student Successfully Remove from Parent');
        return redirect()->back();
    }

    public function myStudentParent()
    {
        $parent_id = Auth::user()->id;
        $data['header_title'] = 'My Student';
        $data['getParentStudents'] = User::getParentStudent($parent_id);
        return view('parent.my_student', $data);
    }
}
