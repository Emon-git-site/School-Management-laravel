@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Timetable</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @foreach ($class_subject_exams as $class)   
                <h2>Class - <span style="color: rgb(253, 141, 225);">{{ $class['class_name'] }}</span></h2>  
                @foreach ($class['exam'] as $exam)   
               
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Exam - <span style="color: rgb(103, 235, 217);">{{ $exam['exam_name'] }}</span></h3></h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Exam Day</th>
                                    <th>Exam Date</th> 
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                    <th>Full Marks</th>
                                    <th>Passing Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam['subject'] as $subject)
                                    <tr>
                                        <td>{{ $subject['subject_name'] }}</td>
                                        <td>{{ date('l', strtotime($subject['exam_date'])) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($subject['exam_date'])) }}</td>
                                        <td>{{ date('h:i A', strtotime($subject['start_time'])) }}</td>
                                        <td>{{ date('h:i A', strtotime($subject['end_time'])) }}</td>
                                        <td>{{ $subject['room_number'] }}</td>
                                        <td>{{ $subject['full_marks'] }}</td>
                                        <td>{{ $subject['passing_marks'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                @endforeach
                @endforeach
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

