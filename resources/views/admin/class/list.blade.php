@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class List </h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.class.add.show') }}" class="btn btn-primary">Add New Class</a>
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
                        <h3 class="card-title">Search Class</h3>
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
                                <input type="date" class="form-control" name="date"
                                    value="{{ Request::get('date') }}">
                            </div>
                            <div class="form-group col-md-3 d-flex align-items-center">
                                <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                <a href="{{ route('admin.class.list') }}" class="btn btn-success btn-outlook"
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
                                <h3 class="card-title">Class list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classe as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>
                                                    @if ($row->status == 0)
                                                        Active
                                                    @else 
                                                    InActive
                                                    @endif
                                                </td>
                                                <td>{{ $row->created_by_name }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($row->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/class/edit/' . $row->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/class/delete/' . $row->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $classe->appends(Request::except('page'))->links() !!}
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
