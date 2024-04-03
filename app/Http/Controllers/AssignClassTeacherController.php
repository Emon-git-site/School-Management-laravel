<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\admin\Subject;
use App\Models\Assign_class_teacher;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list()
    {
        $data['class_teachers'] = Assign_class_teacher::getClassTeacher();
        $data['header_title'] = 'Assign Class Teacher';
        return view('admin.assign_class_teacher.list', $data);
    }

    public function add()
    {
        $data['getSubjectAssign'] = Subject::getSubjectAssign();
        $data['getClassAssign'] = Classe::getClassAssign();
        $data['teachers'] = User::getTeacher();
        $data['header_title'] = 'Add Assign Class Teacher';
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = Assign_class_teacher::getAlreadyFirst($request->classe_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $assign_class_teacher = new Assign_class_teacher;
                    $assign_class_teacher->classe_id = $request->classe_id;
                    $assign_class_teacher->teacher_id = $teacher_id;
                    $assign_class_teacher->status = $request->status;
                    $assign_class_teacher->created_by = Auth::user()->id;
                    $assign_class_teacher->save();
                }
            }
            toastr()->addsuccess('Assign Class to Teacher Successfully');
            return redirect()->route('admin.assign_class_teacher.list');
        } else {
            toastr()->adderror('Due to some error pls try again');
            return redirect()->back();
        }
    }

    public function edit($class_teacher_id)
    {
        $class_teacher = Assign_class_teacher::getSingle($class_teacher_id);
        if (!empty($class_teacher)) {
            $data['class_teacher'] = $class_teacher;
            $data['getAssignTeacherIDs'] = Assign_class_teacher::getAssignTeacherID($class_teacher->classe_id);
            $data['getClassAssign'] = Classe::getClassAssign();
            $data['teachers'] = User::getTeacher();
            $data['header_title'] = 'Edit Assign Class Teacher';
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        Assign_class_teacher::deleteTeacher($request->classe_id);

        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = Assign_class_teacher::getAlreadyFirst($request->classe_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $assign_class_teacher = new Assign_class_teacher;
                    $assign_class_teacher->classe_id = $request->classe_id;
                    $assign_class_teacher->teacher_id = $teacher_id;
                    $assign_class_teacher->status = $request->status;
                    $assign_class_teacher->created_by = Auth::user()->id;
                    $assign_class_teacher->save();
                }
            }
            toastr()->addsuccess('Assign Class to Teacher Update Successfully');
            return redirect()->route('admin.assign_class_teacher.list');
        } else {
            toastr()->adderror('Due to some error pls try again');
            return redirect()->back();
        }
    }

    public function destroy(Assign_class_teacher $class_teacher)
    {
        $class_teacher->is_delete = 1;
        $class_teacher->save();
        toastr()->addsuccess('Assign Teacher Successfully Deleted');
        return redirect()->route('admin.assign_class_teacher.list');
    }

    // single class subject  edit
    public function editSingle(Assign_class_teacher $class_teacher)
    {
        if (!empty($class_teacher)) {
            $data['classteacher'] = $class_teacher;
            $data['getClassAssigns'] = Classe::getClassAssign();
            $data['teachers'] = User::getTeacher();
            $data['header_title'] = 'Edit Assign Subject';
            return view('admin.assign_class_teacher.editSingle', $data);
        } else {
            abort(404);
        }
    }

    public function updateSingle(Request $request, Assign_class_teacher $class_teacher)
    {
        if (!empty($request->teacher_id)) {
            $getAlreadyFirst = Assign_class_teacher::getAlreadyFirst($request->classe_id, $request->teacher_id);
            if (!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
                toastr()->addsuccess('Subject status Successfully Updated');
                return redirect()->route('admin.assign_class_teacher.list');
            } else {
                $class_teacher->classe_id = $request->classe_id;
                $class_teacher->teacher_id = $request->teacher_id;
                $class_teacher->status = $request->status;
                $class_teacher->save();
                toastr()->addsuccess('Teacher Successfully Updated');
                return redirect()->route('admin.assign_class_teacher.list');
            }
        }
    }

    // teacher side work
    public function MyClassSubjectTeacher()
    {
        $data['myClassSubjects'] = Assign_class_teacher::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = 'My Class & Subject';
        return view('teacher.my_class_subject', $data);
    }
}
