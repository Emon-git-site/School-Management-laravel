<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\Class_subjectController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Class_TimeTableController;
use App\Http\Controllers\ExaminationController;
use App\Models\Assign_class_teacher;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login.show');
Route::post('/login', [AuthController::class, 'AuthLogin'])->name('login.perform');
Route::get('/logout', [AuthController::class, 'AuthLogout'])->name('logout');
Route::get('/forget-password', [AuthController::class, 'forgetPasswordShow'])->name('forget-password.show');
Route::post('/forget-password', [AuthController::class, 'forgetPasswordPerform'])->name('forget-password.perform');
Route::get('/reset/{token}', [AuthController::class, 'reset']);
Route::post('/reset/{token}', [AuthController::class, 'PostReset'])->name('reset');


Route::group(['middleware' => 'admin'], function () {
    // admin
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add'])->name('admin.admin.add.show');
    Route::post('admin/admin/add', [AdminController::class, 'insert'])->name('admin.admin.add.perform');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/update/{admin}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{admin}', [AdminController::class, 'destroy']);

    // teacher
    Route::get('admin/teacher/list', [TeacherController::class, 'list'])->name('admin.teacher.list');
    Route::get('admin/teacher/add', [TeacherController::class, 'add'])->name('admin.teacher.add.show');
    Route::post('admin/teacher/add', [TeacherController::class, 'insert'])->name('admin.teacher.add.perform');
    Route::get('admin/teacher/edit/{teacher}', [TeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::post('admin/teacher/update/{teacher}', [TeacherController::class, 'update'])->name('admin.teacher.update');
    Route::get('admin/teacher/delete/{teacher}', [TeacherController::class, 'destroy'])->name('admin.teacher.delete');

    // student
    Route::get('admin/student/list', [StudentController::class, 'list'])->name('admin.student.list');
    Route::get('admin/student/add', [StudentController::class, 'add'])->name('admin.student.add.show');
    Route::post('admin/student/add', [StudentController::class, 'insert'])->name('admin.student.add.perform');
    Route::get('admin/student/edit/{student}', [StudentController::class, 'edit'])->name('admin.student.edit');
    Route::post('admin/student/update/{student}', [StudentController::class, 'update'])->name('admin.student.update');
    Route::get('admin/student/delete/{student}', [StudentController::class, 'destroy'])->name('admin.student.delete');

    // parent
    Route::get('admin/parent/list', [ParentController::class, 'list'])->name('admin.parent.list');
    Route::get('admin/parent/add', [ParentController::class, 'add'])->name('admin.parent.add.show');
    Route::post('admin/parent/add', [ParentController::class, 'insert'])->name('admin.parent.add.perform');
    Route::get('admin/parent/edit/{parent}', [ParentController::class, 'edit'])->name('admin.parent.edit');
    Route::post('admin/parent/update/{parent}', [ParentController::class, 'update'])->name('admin.parent.update');
    Route::get('admin/parent/delete/{parent}', [ParentController::class, 'destroy'])->name('admin.parent.delete');
    Route::get('admin/parent/my-student/{parent}', [ParentController::class, 'myStudent'])->name('admin.parent.my-student');
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'assignStudentParent'])->name('admin.parent.assign_student_parent');
    Route::get('admin/parent/my-assign_student_parent_delete/{student_id}', [ParentController::class, 'assignStudentParentDelete'])->name('admin.parent.assign_student_parent_delete');

    // class route
    Route::get('admin/class/list', [ClassController::class, 'list'])->name('admin.class.list');
    Route::get('admin/class/add', [ClassController::class, 'add'])->name('admin.class.add.show');
    Route::post('admin/class/add', [ClassController::class, 'insert'])->name('admin.class.add.perform');
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/update/{classe}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{classe}', [ClassController::class, 'destroy']);

    // subject route
    Route::get('admin/subject/list', [SubjectController::class, 'list'])->name('admin.subject.list');
    Route::get('admin/subject/add', [SubjectController::class, 'add'])->name('admin.subject.add.show');
    Route::post('admin/subject/add', [SubjectController::class, 'insert'])->name('admin.subject.add.perform');
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/update/{subject}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{subject}', [SubjectController::class, 'destroy']);

    // assign-subject route
    Route::get('admin/assign-subject/list', [Class_subjectController::class, 'list'])->name('admin.assign-subject.list');
    Route::get('admin/assign-subject/add', [Class_subjectController::class, 'add'])->name('admin.assign-subject.add.show');
    Route::post('admin/assign-subject/add', [Class_subjectController::class, 'insert'])->name('admin.assign-subject.add.perform');
    Route::get('admin/assign-subject/edit/{class_subject}', [Class_subjectController::class, 'edit']);
    Route::post('admin/assign-subject/update/{class_subject}', [Class_subjectController::class, 'update']);
    Route::get('admin/assign-subject/edit-single/{class_subject}', [Class_subjectController::class, 'editSingle']);
    Route::post('admin/assign-subject/update-single/{class_subject}', [Class_subjectController::class, 'updateSingle']);
    Route::get('admin/assign-subject/delete/{class_subject}', [Class_subjectController::class, 'destroy']);

    // class time table route
    Route::get('admin/class_timetable/list', [Class_TimeTableController::class, 'list'])->name('admin.class_timetable.list');
    Route::post('admin/class_timetable/get_subject', [Class_TimeTableController::class, 'get_subject'])->name('admin.class_timetable.get_subject');
    Route::post('admin/class_timetable/add', [Class_TimeTableController::class, 'insert_update'])->name('admin.class_timetable.add');


    // assign-class-teacher route
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list'])->name('admin.assign_class_teacher.list');
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add'])->name('admin.assign_class_teacher.add.show');
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert'])->name('admin.assign_class_teacher.add.perform');
    Route::get('admin/assign_class_teacher/edit/{class_teacher_id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/update/{class_teacher}', [AssignClassTeacherController::class, 'update'])->name('admin.assign_class_teacher.update');
    Route::get('admin/assign_class_teacher/edit-single/{class_teacher}', [AssignClassTeacherController::class, 'editSingle']);
    Route::post('admin/assign_class_teacher/update-single/{class_teacher}', [AssignClassTeacherController::class, 'updateSingle']);
    Route::get('admin/assign_class_teacher/delete/{class_teacher}', [AssignClassTeacherController::class, 'destroy']);

    // Exam  route
    Route::get('admin/examinations/exam/list', [ExaminationController::class, 'exam_list'])->name('admin.examinations.exam.list');
    Route::get('admin/examinations/exam/add', [ExaminationController::class, 'exam_create'])->name('admin.examinations.exam.add.show');
    Route::post('admin/examinations/exam/add', [ExaminationController::class, 'exam_insert'])->name('admin.examinations.exam.add.perform');
    Route::get('admin/examinations/exam/edit/{exam_id}', [ExaminationController::class, 'exam_edit'])->name('admin.examinations.exam.edit');
    Route::post('admin/examinations/exam/update/{exam_id}', [ExaminationController::class, 'exam_update'])->name('admin.examinations.exam.update');
    Route::get('admin/examinations/exam/delete/{exam_id}', [ExaminationController::class, 'exam_destroy'])->name('admin.examinations.exam.delete');

    // Exam Schedule route
    Route::get('admin/examinations/exam_schedule', [ExaminationController::class, 'exam_schedule'])->name('admin.examinations.exam_schedule');
    Route::post('admin/examinations/exam_schedule/add', [ExaminationController::class, 'exam_schedule_insert'])->name('admin.examinations.exam_schedule.add.perform');


    // account
    Route::get('admin/account/edit', [UserController::class, 'myAccount'])->name('admin.account.edit');
    Route::post('admin/account/update', [UserController::class, 'updateAccountAdmin'])->name('admin.account.update');
    // password_change
    Route::get('admin/change_password', [UserController::class, 'change_passwordShow'])->name('admin.change_password.show'); 
    Route::post('admin/change_password', [UserController::class, 'change_passwordUpdate']);
});


Route::group(['middleware' => 'teacher'], function () {
    // dashboard
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');

    // my student
    Route::get('teacher/my_student', [StudentController::class, 'myStudent'])->name('teacher.my_student');

    // my_class_subjec
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubjectTeacher'])->name('teacher.my_class_subject');

    // timetable
    Route::get('teacher/my_class_subject/class_timetable/{classe_id}/{subject_id}', [Class_TimeTableController::class, 'MyTimetableTeacher'])->name('teacher.my_class_subject.class_timetable');
    Route::get('teacher/my_exam_timetable', [ExaminationController::class, 'MyExamTimetableTeacher'])->name('teacher.my_exam_timetable');

    // calendar
    Route::get('teacher/my_student/calendar', [CalendarController::class, 'myStudentCalendarTeacher'])->name('teacher.my_calendar');

    // account
    Route::get('teacher/account/edit', [UserController::class, 'myAccount'])->name('teacher.account.edit');
    Route::post('teacher/account/update', [UserController::class, 'updateAccountTeacher'])->name('teacher.account.update');

    // password_change
    Route::get('teacher/change_password', [UserController::class, 'change_passwordShow'])->name('teacher.change_password.show');
    Route::post('teacher/change_password', [UserController::class, 'change_passwordUpdate']);
});


Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');

    // account
    Route::get('student/account/edit', [UserController::class, 'myAccount'])->name('student.account.edit');
    Route::post('student/account/update', [UserController::class, 'updateAccountStudent'])->name('student.account.update');

    // subject
    Route::get('student/my_subject', [SubjectController::class, 'MySubjectStudent'])->name('student.my_subject');

    // timetable
    Route::get('student/my_timetable', [Class_TimeTableController::class, 'MyTimetableStudent'])->name('student.my_timetable');
    Route::get('student/my_exam_timetable', [ExaminationController::class, 'MyExamTimetableStudent'])->name('student.my_exam_timetable');

    // calendar
    Route::get('student/my_calendar', [CalendarController::class, 'myCalendarStudent'])->name('student.my_calendar');


    // password_change
    Route::get('student/change_password', [UserController::class, 'change_passwordShow'])->name('student.change_password.show');
    Route::post('student/change_password', [UserController::class, 'change_passwordUpdate']);
});


Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');

    // account
    Route::get('parent/account/edit', [UserController::class, 'myAccount'])->name('parent.account.edit');
    Route::post('parent/account/update', [UserController::class, 'updateAccountParent'])->name('parent.account.update');

    // password_change
    Route::get('parent/change_password', [UserController::class, 'change_passwordShow'])->name('parent.change_password.show');
    Route::post('parent/change_password', [UserController::class, 'change_passwordUpdate']);

    Route::get('parent/my_student', [ParentController::class, 'myStudentParent'])->name('parent.my_student');
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'parentstudentSubject'])->name('parent.my_student.subject');

    // timetable
    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationController::class, 'myStudentExamTimetableParent'])->name('parent.my_student.exam_timetable');
    Route::get('parent/my_student/subject/timetable/{classe_id}/{subject_id}/{student_id}', [Class_TimeTableController::class, 'MyTimetableParents'])->name('parent.my_student.subject.timetable');

    // calendar
    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'myStudentCalendarParent'])->name('parent.my_student.calendar');
});
