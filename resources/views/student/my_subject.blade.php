@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Subject(Class-{{$mySubjects[0]['class_name']; }})</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>My Class Timetable Today</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mySubjects as $mySubject)
                                        <tr>
                                            <td>{{ $mySubject['subject_name'] }}</td>
                                            <td>{{ $mySubject['subject_type'] }}</td>
                                            <td>
                                                @if(!empty($mySubject['subject_timetable']))
                                                @foreach ($mySubject['subject_timetable'] as $subjectTimeatable)
                                                {{ date('h:i A', strtotime($subjectTimeatable['start_time'])) }} to
                                                {{ date('h:i A', strtotime($subjectTimeatable['end_time'])) }}
                                                <br>
                                                Room number: {{ $subjectTimeatable['room_number'] }}
                                                @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
