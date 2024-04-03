@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject List </h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.subject.add.show') }}" class="btn btn-primary">Add New Subject</a>
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
                        <h3 class="card-title">Search Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form action="" method="get">
                        <div class="row p-1">
                            <div class="form-group  col-md-3">
                                <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}"
                                    placeholder="Enter Name">
                            </div>
                            <div class="form-group  col-md-3">
                                <select class="form-control" name="type" required>
                                    <option value="">Choose Subject Type</option>
                                    <option value="Theory">Theory</option>
                                    <option value="Practical">Practical</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-3">
                                <input type="date" class="form-control" name="date"
                                    value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center">
                                <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                <a href="{{ route('admin.subject.list') }}" class="btn btn-success btn-outlook"
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
                                <h3 class="card-title">Subject list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>
                                                    @if($subject->type == "Practical")
                                                        Practical
                                                    @else
                                                        Theory
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    @if ($subject->status == 0)
                                                        Active
                                                    @else 
                                                    InActive
                                                    @endif
                                                </td>
                                                <td>{{ $subject->created_by_name }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($subject->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/subject/edit/' . $subject->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/subject/delete/' . $subject->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $subjects->appends(Request::except('page'))->links() !!}
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
