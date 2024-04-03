@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Student Subject(name: <span style="color: blue">{{ $student->name }} {{ $student->last_name }}</span>, Class-<span style="color: blue">{{ $mySubjects->first()->class_name }}</span>)</h1>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mySubjects as $mySubject)
                                            <tr>
                                                <td>{{ $mySubject->subject_name }}</td>
                                                <td>{{ $mySubject->subject_type }}</td>
                                                <td>
                                                    <a href="{{ route('parent.my_student.subject.timetable', ['classe_id' => $mySubject->classe_id, 
                                                        'subject_id' => $mySubject->subject_id, 'student_id' => $student->id]) }}"   class="btn btn-primary">My Class Timetable</a>
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
