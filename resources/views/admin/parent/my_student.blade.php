@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Parent Student List (Total: {{ $parents->total() }})</h1> --}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Student</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row p-1">
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="id"
                                        value="{{ Request::get('id') }}" placeholder="Student ID">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Request::get('name') }}" placeholder="First Name">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ Request::get('last_name') }}" placeholder="Last Name">
                                </div>
                                <div class="form-group  col-md-3">
                                    <input type="text" class="form-control" name="email"
                                        value="{{ Request::get('email') }}" placeholder="Email Address">
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-center">
                                    <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                    <a href="{{ route('admin.parent.my-student', $parent_id) }}"
                                        class="btn btn-success btn-outlook" role="button">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @if(!empty($getSearchStudents))
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Studen ID</th>
                                            <th>Profile Pic</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getSearchStudents as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>
                                                @if ($student->getProfile())
                                                    <img src="{{ $student->getProfile() }}"
                                                        style="height: 50px; width:50px; border-radius:50px;">
                                                @endif
                                            </td>
                                            <td>{{ $student->name }} {{ $student->last_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->parent_name ?? 'No Parent' }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($student->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.parent.assign_student_parent', ['student_id' => $student->id, 'parent_id' => $parent_id]) }}"
                                                    class="btn btn-sm btn-primary">Add Student to Parent</a>
                                                 
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
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent Student list:({{ $singleParent->name }} {{ $singleParent->last_name }})</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Studen ID</th>
                                            <th>Profile Pic</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getParentStudents as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>
                                                @if ($student->getProfile())
                                                    <img src="{{ $student->getProfile() }}"
                                                        style="height: 50px; width:50px; border-radius:50px;">
                                                @endif
                                            </td>
                                            <td>{{ $student->name }} {{ $student->last_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->parent_name ?? 'No Parent' }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($student->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.parent.assign_student_parent_delete', $student->id) }}"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                                 
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
