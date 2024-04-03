@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>teacher List (Total: {{ $teachers->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.teacher.add.show') }}" class="btn btn-primary">Add New teacher</a>
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
                        <h3 class="card-title">Search teacher</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row p-1">
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
                                <div class="form-group col-md-2">
                                    <select name="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option {{ Request::get('gender') == 'Male' ? 'selected' : '' }} value="Male">Male
                                        </option>
                                        <option {{ Request::get('gender') == 'Female' ? 'selected' : '' }} value="Female">
                                            Female</option>
                                        <option {{ Request::get('gender') == 'Other' ? 'selected' : '' }} value="Other">
                                            Other</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-3">
                                    <input type="text" class="form-control" name="mobile_number"
                                        value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="marital_status"
                                        value="{{ Request::get('marital_status') }}" placeholder="Marital Status">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ Request::get('address') }}" placeholder="Current Address">
                                </div>
                                <div class="form-group col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option {{ Request::get('status') == '0' ? 'selected' : '' }} value="0">Active
                                        </option>
                                        <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">
                                            Inactive</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-4" style="display: flex; align-items: center;">
                                    <label for="date" style="margin-right: 10px; font-weight: normal;"> Date of Joining:</label>
                                    <input type="date" class="form-control" name="admission_date" value="{{ Request::get('admission_date') }}">
                                </div>  
                                <div class="form-group col-md-4" style="display: flex; align-items: center;">
                                    <label for="date" style="margin-right: 10px; font-weight: normal;"> Created Date:</label>
                                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-center">
                                    <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                    <a href="{{ route('admin.teacher.list') }}"
                                        class="btn btn-success btn-outlook" role="button">Reset</a>
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
                                <h3 class="card-title">teacher list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile Pic</th>
                                            <th>Teacher Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Date of Joining</th>
                                            <th>Mobile Number</th>
                                            <th>Marital Status</th>
                                            <th>Current Address</th>
                                            <th>Permanent Address</th>
                                            <th>Qualification</th>
                                            <th>Work Experience</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ $teacher->id }}</td>
                                                <td>
                                                    @if ($teacher->getProfile())
                                                        <img src="{{ $teacher->getProfile() }}"
                                                            style="height: 50px; width:50px; border-radius:50px;">
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->name }} {{ $teacher->last_name }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ $teacher->gender }}</td>

                                                <td>
                                                    @if (!@empty($teacher->date_of_birth))
                                                        {{ date('d-m-Y', strtotime($teacher->date_of_birth)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!@empty($teacher->admission_date))
                                                        {{ date('d-m-Y', strtotime($teacher->admission_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->mobile_number }}</td>
                                                <td>{{ $teacher->marital_status }}</td>
                                                <td>{{ $teacher->address }}</td>
                                                <td>{{ $teacher->permanent_address }}</td>
                                                <td>{{ $teacher->qualification }}</td>
                                                <td>{{ $teacher->work_experience }}</td>
                                                <td>{{ $teacher->note }}</td>
                                                <td>{{ $teacher->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($teacher->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('admin.teacher.delete', $teacher->id) }}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $teachers->appends(Request::except('page'))->links() !!}
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
