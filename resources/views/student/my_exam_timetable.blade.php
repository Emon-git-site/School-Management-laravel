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
                @foreach ($exam_timetables as $exam_timetable)                    
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="color: rgb(103, 235, 217);">{{ $exam_timetable['exam_name'] }}</h3>
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
                                @foreach ($exam_timetable['exam'] as $exam)
                                    <tr>
                                        <td>{{ $exam['subject_name'] }}</td>
                                        <td>{{ date('l', strtotime($exam['exam_date'])) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($exam['exam_date'])) }}</td>
                                        <td>{{ date('h:i A', strtotime($exam['start_time'])) }}</td>
                                        <td>{{ date('h:i A', strtotime($exam['end_time'])) }}</td>
                                        <td>{{ $exam['room_number'] }}</td>
                                        <td>{{ $exam['full_marks'] }}</td>
                                        <td>{{ $exam['passing_marks'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                @endforeach
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

