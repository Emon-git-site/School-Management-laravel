<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function list()
    { 
        $data['header_title'] = 'Student List';
        $data['students'] = User::getStudent();
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClassAssigns'] = Classe::getClassAssign();
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'weight' => 'max:10',
            'blood_group' => 'max:10',
        ]);
        $student = User::make($request->except('password', 'profie_pic'));
        $student->password = Hash::make($request->password);
        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $destinationPath = public_path('upload/profile');
            $file->move($destinationPath, $filename);
            $student->profile_pic = $filename;
        }
        $student->save();
        toastr()->addsuccess('Student Successfully Created');
        return redirect()->route('admin.student.list');
    }

    public function edit(User $student)
    {
        $data['student'] = $student;
        if(!empty($data['student']))
        {
            $data['classes'] = Classe::getClassAssign();
            $data['header_title'] = 'Edit Student';
            return view('admin.student.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request, User $student)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $student->id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
        ]);
        $student->fill($request->except('password', 'profie_pic'));
        if(!empty($student->password))
        {
            $student->password = Hash::make($request->password);
        }
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
        toastr()->addsuccess('Student Successfully Updated');
        return redirect()->route('admin.student.list');
    }

    
    public function destroy(User $student)
    {
        $student->is_delete = 1;
        $student->save();
        toastr()->addsuccess('Student Successfully Deleted');
        return redirect()->route('admin.student.list');
    }

    public function myStudent()
    {
        $data['header_title'] = 'My Student List';
        $data['students'] = User::getTeacherStudent(Auth::user()->id);
        return view('teacher.my_student', $data);
    }
}
