<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeekModel1;
use Illuminate\Http\Request;
use App\Models\ExamSchedulModel;
use App\Models\admin\Class_subject;
use App\Models\Assign_class_teacher;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetable;

class CalendarController extends Controller
{
    // student side
    public function myCalendarStudent()
    {
        $data['getMyTimetable'] = $this->getTimetable(Auth::user()->classe_id);
        $data['getExamTimetable'] = $this->getExamTimetable(Auth::user()->classe_id);
        $data['header_title'] = 'My Calendar';
        return view('student.my_calendar', $data);
    }

    public function getExamTimetable($class_id)
    {
        $getExams = ExamSchedulModel::getExam($class_id);
        $result = array();
        foreach($getExams as $getExam)
        {
            $dataE = array();
            $dataE['exam_name'] = $getExam->exam_name;
            $getExamTimetables = ExamSchedulModel::getExamTimetable($getExam->exam_id, $getExam->class_id);
            $resultS = array();
            foreach($getExamTimetables as $getExamTimetable)
            {
                $dataS = array();
                $dataS['subject_name'] = $getExamTimetable->subject_name;
                $dataS['exam_date'] = $getExamTimetable->exam_date;
                $dataS['start_time'] = $getExamTimetable->start_time;
                $dataS['end_time'] = $getExamTimetable->end_time;
                $dataS['room_number'] = $getExamTimetable->room_number;
                $dataS['full_marks'] = $getExamTimetable->full_marks;
                $dataS['passing_marks'] = $getExamTimetable->passing_marks;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        return $result;
    }

    public function getTimetable($class_id)
    {
        $result = array();
        $mySubjects = Class_subject::mySubjectName($class_id);
        foreach($mySubjects as $mySubject)
        {
            $dataS['subject_name'] = $mySubject->subject_name;
            $getWeeks = WeekModel1::getWeekRecord();
            $week = array();
            foreach($getWeeks as $getWeek)
            {
                $dataW = array();
                $dataW['week_name'] = $getWeek->name;
                $dataW['fullcalendar_day'] = $getWeek->fullcalendar_day;
                $class_subject = ClassSubjectTimetable::getRecordClassSubject($mySubject->classe_id, $mySubject->subject_id, $getWeek->id);
                if(!empty($class_subject))
                {
                    $dataW['start_time'] = $class_subject->start_time;
                    $dataW['end_time'] = $class_subject->end_time;
                    $dataW['room_number'] = $class_subject->room_number;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        return $result;
    }

    // parent side
    public function myStudentCalendarParent($student_id)
    {
        $getStudent = User::find($student_id);
        $data['getMyTimetable'] = $this->getTimetable($getStudent->classe_id);
        $data['getExamTimetable'] = $this->getExamTimetable($getStudent->classe_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'My Student Calendar';
        return view('parent.my_calendar', $data);
    }

    // teacher side
    public function myStudentCalendarTeacher()
    {
        $teacher_id = Auth::user()->id;

        $getClassTimetable = Assign_class_teacher::getCalendarTeacher($teacher_id);
        dd($getClassTimetable);
        $data['header_title'] = 'My  Calendar';
        return view('teacher.my_calendar', $data);
    }
}
