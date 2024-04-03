<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeekModel1;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\admin\Subject;
use App\Models\admin\Class_subject;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetable;
use PhpParser\Node\Expr\FuncCall;

class Class_TimeTableController extends Controller
{

    // admin side
    public function list(Request $request)
    {
        if(!empty($request->class_id))
        {
            $data['getSubject'] = Class_subject::mySubjectName($request->class_id);
        }

        $getWeeks = WeekModel1::getWeekRecord();
        $week = array();
        foreach($getWeeks as $getWeek)
        {
            $dataW = array();
            $dataW['week_id'] = $getWeek->id;
            $dataW['week_name'] = $getWeek->name;
            if(!empty($request->class_id) && !empty($request->subject_id))
            {
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($request->class_id, $request->subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
            }
            else
            {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
            }
            $week[] = $dataW;
        }
        $data['weeks'] = $week;
        $data['getClass'] = Classe::getClass();
        $data['header_title'] = 'Class Timetable';
        return view('admin.class_timetable.list', $data);
    }

    // admin side get subject after selecting class
    public function get_subject(Request $request)
    {
        $getSubject = Class_subject::mySubjectName($request->class_id);
        $html = "<option value=''>Select Subject</option>";
    
        foreach($getSubject as $subject)
        {
            $html .= "<option value='".$subject->subject_id."'>".$subject->subject_name."</option>";
        }
    
        $json['html'] = $html;
    
        return response()->json($json);
    }
    
    // admin side time insert and update for a  specific subject
    public function insert_update(Request $request)
    {
        ClassSubjectTimetable::where('classe_id', $request->class_id)->where('subject_id', $request->subject_id)->delete();
        foreach($request->timetable as $timetable)
        {
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']))
            {
                $class_subject_timetable = new ClassSubjectTimetable();
                $class_subject_timetable->classe_id = $request->class_id;
                $class_subject_timetable->subject_id = $request->subject_id;
                $class_subject_timetable->week_id = $timetable['week_id'];
                $class_subject_timetable->start_time = $timetable['start_time'];
                $class_subject_timetable->end_time = $timetable['end_time'];
                $class_subject_timetable->room_number = $timetable['room_number'];
                $class_subject_timetable->save();
            }
        }
        toastr()->addsuccess('Class Timetable Successfully Saved');
        return redirect()->back();
    }

    // student side time table
    public function MyTimetableStudent(Request $request)
    {
        $result = array();
        $mySubjects = Class_subject::mySubjectName(Auth::user()->classe_id);
        foreach($mySubjects as $mySubject)
        {
            $data['subject_name'] = $mySubject->subject_name;
            $getWeeks = WeekModel1::getWeekRecord();
            $week = array();
            foreach($getWeeks as $getWeek)
            {
                $dataW = array();
                $dataW['week_name'] = $getWeek->name;
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($mySubject->classe_id, $mySubject->subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                $week[] = $dataW;
            }
            $data['week'] = $week;
            $result[] = $data;
        }
        $data['class_schedules'] =$result;
        $data['header_title'] = 'MY Timetable';
        return view('student.my_timetable', $data);
    }

    // teacher side class time table
    public  function MyTimetableTeacher($class_id, $subject_id)
    {
        $data['getClass'] = Classe::find($class_id);
        $data['getSubject'] = Subject::find($subject_id);
            $getWeeks = WeekModel1::getWeekRecord();
            foreach($getWeeks as $getWeek)
            {
                $dataW = array();
                $dataW['week_name'] = $getWeek->name;
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                $result[] = $dataW;
            }
        $data['class_schedules'] =$result;
        $data['header_title'] = 'MY Timetable';
        return view('teacher.my_timetable', $data);
    }


    // parents side class time table
    public  function MyTimetableParents($class_id, $subject_id, $student_id)
    {
        $data['getClass'] = Classe::find($class_id);
        $data['getSubject'] = Subject::find($subject_id);
        $data['getStudent'] = User::find($student_id);
            $getWeeks = WeekModel1::getWeekRecord();
            foreach($getWeeks as $getWeek)
            {
                $dataW = array();
                $dataW['week_name'] = $getWeek->name;
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($class_id, $subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                }
                else
                {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                }
                $result[] = $dataW;
            }
        $data['class_schedules'] =$result;
        $data['header_title'] = 'MY Timetable';
        return view('parent.my_timetable', $data);
    }

}
