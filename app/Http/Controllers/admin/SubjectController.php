<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\admin\Subject;
use PhpParser\Node\Expr\FuncCall;
use App\Models\admin\Class_subject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetable;

class SubjectController extends Controller
{
    public function list()
    {
        $data['subjects'] = Subject::getSubject();
        $data['header_title'] = 'Subject List';
        return view('admin.subject.list', $data);
    }

    
    public function add()
    {
        $data['header_title'] = 'Add new Subject';
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);

        $subject = Subject::make($request->except('created_by'));
        $subject->created_by = Auth::user()->id;
        $subject->save();
        toastr()->addsuccess('Subject Successfully Created');
        return redirect()->route('admin.subject.list');
    }

    
    public function edit($id)
    {
        $data['subject'] = Subject::where('id', $id)->first();
        if(!empty($data['subject']))
        {
            $data['header_title'] = "Edit Subject";
            return view('admin.subject.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update(Request $request ,Subject $subject)
    {
        request()->validate([
            'name' => 'required|string|max:255'
        ]);
        $subject->update($request->all());
        toastr()->addsuccess('Subject  Information Updated Successfully ');
        return redirect()->route('admin.subject.list');
    }

    
    public function destroy(Subject $subject)
    {
        $subject->is_delete = 1;
        $subject->save();
        toastr()->addsuccess('Subject Successfully Deleted');
        return redirect()->route('admin.subject.list');
    }

    // student side
    public function MySubjectStudent()
    {
        $mySubjects = Class_subject::mySubjectName(Auth::user()->classe_id);
        $subjectSchedule =array();
        foreach($mySubjects as $mySubject)
        {
            $dataS = array();
            $dataS['subject_id'] = $mySubject->subject_id;
            $dataS['subject_name'] = $mySubject->subject_name;
            $dataS['subject_type'] = $mySubject->subject_type;
            $dataS['class_name'] = $mySubject->class_name;
            $subjectTimetables = ClassSubjectTimetable::subjectTimetable($mySubject->subject_id, Auth::user()->classe_id);

            $subejectTimetableArray = array();
            foreach($subjectTimetables as $subjectTimetable)
            {
                $dataT = array();
                $dataT['start_time'] = $subjectTimetable->start_time;
                $dataT['end_time'] = $subjectTimetable->end_time;
                $dataT['room_number'] = $subjectTimetable->room_number;
                $subejectTimetableArray[] = $dataT;
            }

            $dataS['subject_timetable'] = $subejectTimetableArray;
            $subjectSchedule[] = $dataS;
        }
        $data['mySubjects'] = $subjectSchedule;
        $data['header_title'] = 'My Subject';
        return view('student.my_subject', $data);
    }

    // parent side
    public function parentstudentSubject($student_id)
    {
         $student = User::getSingle($student_id);
         $data['student'] = $student;
         $data['mySubjects'] = Class_subject::mySubjectName($student->classe_id);
         $data['header_title'] = 'Student Subject';
         return view('parent.my_student_subject', $data);
    }
}
