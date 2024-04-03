@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Exam Schedule</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.examinations.exam.add.show') }}" class="btn btn-primary">Add New Exam</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Exam Schedule</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form action="" method="get">
                        <div class="row p-1">
                            <div class="form-group  col-md-3">
                                <select class="form-control" name="exam_id" required>
                                    <option value="">Select Exam</option>
                                    @foreach ($getExam as $exam)
                                    <option {{ (Request('exam_id') == $exam->id)? 'selected':'' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-3">
                                <select class="form-control" name="class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($getClass as $class)
                                        <option {{ (Request('class_id') == $class->id)? 'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center">
                                <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                <a href="{{ route('admin.examinations.exam_schedule') }}" class="btn btn-success btn-outlook"
                                    role="button">Reset</a>
                            </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- Small boxes (Stat box) -->
                @if(!empty($exam_schedules))
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.examinations.exam_schedule.add.perform') }}" method="post">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ Request('exam_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request('class_id') }}">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exam Schedule</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                            <th>Full Marks</th>
                                            <th>Passing Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($exam_schedules as $exam_schedule)
                                            <tr>
                                                <td>{{ $exam_schedule['subject_name'] }}
                                                    <input type="hidden" class="form-control" value="{{ $exam_schedule['subject_id'] }}" name="schedule[{{ $i }}][subject_id]">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" value="{{ $exam_schedule['exam_date'] }}" name="schedule[{{ $i }}][exam_date]">
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" value="{{ $exam_schedule['start_time'] }}" name="schedule[{{ $i }}][start_time]">
                                                </td>
                                                <td>
                                                    <input type="time" class="form-control" value="{{ $exam_schedule['end_time'] }}" name="schedule[{{ $i }}][end_time]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="{{ $exam_schedule['room_number'] }}" name="schedule[{{ $i }}][room_number]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="{{ $exam_schedule['full_marks'] }}" name="schedule[{{ $i }}][full_marks]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="{{ $exam_schedule['passing_marks'] }}" name="schedule[{{ $i }}][passing_marks]">
                                                </td>
                                            </tr>
                                        @php
                                        $i++;
                                    @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="text-align: center; padding: 20px">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
                @endif
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
