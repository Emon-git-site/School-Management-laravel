@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Class Teacher List ({{ $class_teachers->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.assign_class_teacher.add.show') }}" class="btn btn-primary">Add Assign Class Teacher</a>
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
                        <h3 class="card-title">Search Assign Teacher</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form action="" method="get">
                        <div class="row p-1">
                            <div class="form-group  col-md-3">
                                <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}"
                                    placeholder="Enter Class Name">
                            </div>
                            <div class="form-group  col-md-3">
                                <input type="text" class="form-control" name="teacher_name" value="{{ Request::get('teacher_name') }}"
                                    placeholder="Enter Teacher Name">
                            </div>
                            <div class="form-group  col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option {{ Request::get('status') == '0' ? 'selected' : '' }} value="0">Active
                                    </option>
                                    <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">
                                        Inactive</option>

                                </select>
                            </div>
                            <div class="form-group  col-md-3">
                                <input type="date" class="form-control" name="date"
                                    value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center">
                                <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                <a href="{{ route('admin.assign_class_teacher.list') }}" class="btn btn-success btn-outlook"
                                    role="button">Reset</a>
                            </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Class Teacher List</h3>
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
                                            <th>Teacher Name</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_teachers as $class_teacher)
                                            <tr>
                                                <td>{{ $class_teacher->id }}</td>
                                                <td>{{ $class_teacher->class_name }}</td>
                                                <td>{{ $class_teacher->teacher_name }}</td>
                                                <td>{{ $class_teacher->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ $class_teacher->created_by_name }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($class_teacher->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/assign_class_teacher/edit/' . $class_teacher->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/assign_class_teacher/edit-single/' . $class_teacher->id) }}"
                                                        class="btn btn-primary">Edit Single</a>
                                                    <a href="{{ url('admin/assign_class_teacher/delete/' . $class_teacher->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $class_teachers->appends(Request::except('page'))->links() !!}
                                </div>
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
