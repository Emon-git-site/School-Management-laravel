@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Class & Subject</h1>
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
                            <div class="card-header">
                                <h3 class="card-title">My Class & Subject</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>My Class Today Timetable</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($myClassSubjects as $myClassSubject)
                                            <tr>
                                                <td>{{ $myClassSubject->id }}</td>
                                                <td>{{ $myClassSubject->class_name }}</td>
                                                <td>{{ $myClassSubject->subject_name }}</td>
                                                <td>{{ $myClassSubject->subject_type }}</td>
                                                <td>
                                                    @php
                                                        $class_subject = $myClassSubject->getMyTimeTable(
                                                            $myClassSubject->classe_id,
                                                            $myClassSubject->subject_id,
                                                        );
                                                    @endphp
                                                    @if (!empty($class_subject))
                                                        {{ date('h:i A', strtotime($class_subject->start_time)) }} to
                                                        {{ date('h:i A', strtotime($class_subject->end_time)) }}
                                                        <br>
                                                        Room number: {{ $class_subject->room_number }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($myClassSubject->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('teacher.my_class_subject.class_timetable', [
                                                        'classe_id' => $myClassSubject->classe_id,
                                                        'subject_id' => $myClassSubject->subject_id,
                                                    ]) }}"
                                                        class="btn btn-primary">My Class Timetable</a>
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
