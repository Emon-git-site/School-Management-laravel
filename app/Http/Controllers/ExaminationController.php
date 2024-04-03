<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExamModel;
use Illuminate\Support\Arr;
use App\Models\admin\Classe;
use Illuminate\Http\Request;
use App\Models\ExamSchedulModel;
use App\Models\admin\Class_subject;
use App\Models\Assign_class_teacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\Class_subjectController;

class ExaminationController extends Controller
{
    public function exam_list()
    {
        $data['header_title'] = 'Admin List';
        $data['getExamRecords'] = ExamModel::getExamRecord();
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_create()
    {
        $data['header_title'] = 'Add New Exam';
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        $exam = new ExamModel();
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->created_by = Auth::user()->id;
        $exam->save();

        toastr()->addsuccess('Exam Successfully Created');
        return redirect()->route('admin.examinations.exam.list');
    }

    public function exam_edit($exam_id)
    {
        $data['getExamRecord'] = ExamModel::find($exam_id);
        if (!empty($data['getExamRecord'])) {
            $data['header_title'] = 'Edit Exam';
            return view('admin.examinations.exam.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function exam_update(Request $request, $exam_id)
    {
        $exam = ExamModel::find($exam_id);
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->save();

        toastr()->addsuccess('Exam Successfully Updated');
        return redirect()->route('admin.examinations.exam.list');
    }

    
    public function exam_destroy($exam_id)
    {
        $exam = ExamModel::find($exam_id);
        if(!empty($exam))
        {
            $exam->is_delete = 1;
            $exam->save();
            toastr()->addsuccess('Exam Successfully Deleted');
            return redirect()->route('admin.examinations.exam.list');
        }
        else
        {
            abort(404);
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = Classe::getClass();
        $data['getExam'] = ExamModel::getExam();
        $result = array();
        if(!empty(Request('exam_id')) && !empty(Request('class_id')))
        {
            $class_Subjects = Class_subject::mySubjectName(Request('class_id'));
               foreach($class_Subjects as $class_Subject)
               {  
                $dataS = array();
                $dataS['subject_id'] = $class_Subject->subject_id;
                $dataS['class_id'] = $class_Subject->classe_id;
                $dataS['subject_name'] = $class_Subject->subject_name;
                $dataS['subject_type'] = $class_Subject->subject_type;

                $exam_schedule = ExamSchedulModel::getRecordSingle(Request('exam_id'), Request('class_id'), $class_Subject->subject_id);
                if(!empty($exam_schedule))
                {
                    $dataS['exam_date'] = $exam_schedule->exam_date;
                    $dataS['start_time'] = $exam_schedule->start_time;
                    $dataS['end_time'] = $exam_schedule->end_time;
                    $dataS['room_number'] = $exam_schedule->room_number;
                    $dataS['full_marks'] = $exam_schedule->full_marks;
                    $dataS['passing_marks'] = $exam_schedule->passing_marks;
                }
                else
                {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_marks'] = '';
                    $dataS['passing_marks'] = '';
                }
                $result[] = $dataS;
               }
        }
        $data['exam_schedules'] = $result;
        $data['header_title'] = 'Exam Schedule';
        return view('admin.examinations.exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        ExamSchedulModel::deleteRecord(Request('exam_id'), Request('class_id'));
        if(!empty($request->schedule))
        {
            foreach($request->schedule as $schedule)
            {
                if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && 
                !empty($schedule['start_time']) && !empty($schedule['end_time']) &&
                !empty($schedule['room_number']) && !empty($schedule['full_marks']) &&
                !empty($schedule['passing_marks']))
                {
                    $exam_schedule = ExamSchedulModel::create([
                        'exam_id' => $request->exam_id,
                        'class_id' => $request->class_id,
                        'subject_id' => $schedule['subject_id'],
                        'exam_date' => $schedule['exam_date'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                        'room_number' => $schedule['room_number'],
                        'full_marks' => $schedule['full_marks'],
                        'passing_marks' => $schedule['passing_marks'],
                        'created_by' => Auth::user()->id
                    ]);
                }
            }
            toastr()->addsuccess('Exam Schedule Successfully Saved');
            return redirect()->back();
        }
    }

    // student side
    public function MyExamTimetableStudent(Request $request)
    {
        $class_id = Auth::user()->classe_id;
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
        $data['exam_timetables'] = $result;
        $data['header_title'] = 'My Exam Timetable';
        return view('student.my_exam_timetable', $data);
    }

    // teacher side
    public function MyExamTimetableTeacher()
    {
        $result = array();
        $myClassSubjects = Assign_class_teacher::getMyClassSubjectGroup(Auth::user()->id);
        foreach($myClassSubjects as $class)
        {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;
            $getExams = ExamSchedulModel::getExam($class->classe_id);
            $examArray = array();
            foreach($getExams as $exam)
            {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $getExamTimetables = ExamSchedulModel::getExamTimetable($exam->exam_id, $class->class_id);
                $subjectArray = array();
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
                    $subjectArray[] = $dataS;
                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;
            $result[] = $dataC;
        }
        $data['class_subject_exams'] = $result;
        $data['header_title'] = 'My Exam Timetable';
        return view('teacher.my_exam_timetable', $data);
    }

    // parent side
    public function myStudentExamTimetableParent($student_id )
    {
        $getStudent = User::find($student_id);
        $class_id = $getStudent->classe_id;
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
        $data['student'] = $getStudent;
        $data['getClassName'] = Classe::find($class_id);
        $data['exam_timetables'] = $result;
        $data['header_title'] = ' Exam Timetable';
        return view('parent.myStudent_exam_timetable', $data);
    }
}
