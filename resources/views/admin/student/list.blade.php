@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total: {{ $students->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.student.add.show') }}" class="btn btn-primary">Add New Student</a>
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
                        <h3 class="card-title">Search Student</h3>
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
                                <div class="form-group  col-md-3">
                                    <input type="text" class="form-control" name="admission_number"
                                        value="{{ Request::get('admission_number') }}" placeholder="Admission Number">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="roll_number"
                                        value="{{ Request::get('roll_number') }}" placeholder="Roll Number">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="classe"
                                        value="{{ Request::get('classe') }}" placeholder="Class">
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
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="caste"
                                        value="{{ Request::get('caste') }}" placeholder="Caste">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="religion"
                                        value="{{ Request::get('religion') }}" placeholder="Religiion">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="mobile_number"
                                        value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                                </div>
                                <div class="form-group  col-md-2">
                                    <input type="text" class="form-control" name="blood_group"
                                        value="{{ Request::get('blood_group') }}" placeholder="Blood Group">
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
                                    <label for="date" style="margin-right: 10px; font-weight: normal;"> Amission Date:</label>
                                    <input type="date" class="form-control" name="admission_date" value="{{ Request::get('admission_date') }}">
                                </div>  
                                <div class="form-group col-md-4" style="display: flex; align-items: center;">
                                    <label for="date" style="margin-right: 10px; font-weight: normal;"> Created Date:</label>
                                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                                </div>
                                

                                <div class="form-group col-md-2 d-flex align-items-center">
                                    <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                    <a href="{{ route('admin.student.list') }}"
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
                                <h3 class="card-title">Student list</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>Student Name</th>
                                            <th>Parent Name</th>
                                            <th>Email</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Caste</th>
                                            <th>Religion</th>
                                            <th>Mobile Number</th>
                                            <th>Admission Date</th>
                                            <th>Blood Group</th>
                                            <th>Height</th>
                                            <th>Weigth</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($student->getProfile())
                                                        <img src="{{ $student->getProfile() }}"
                                                            style="height: 50px; width:50px; border-radius:50px;">
                                                    @endif
                                                </td>
                                                <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                <td>{{ $student->parent_name }} {{ $student->parent_last_name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->admission_number }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ $student->class_name }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>
                                                    @if (!@empty($student->date_of_birth))
                                                        {{ date('d-m-Y', strtotime($student->date_of_birth)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $student->caste }}</td>
                                                <td>{{ $student->religion }}</td>
                                                <td>{{ $student->mobile_number }}</td>
                                                <td>
                                                    @if (!@empty($student->admission_date))
                                                        {{ date('d-m-Y', strtotime($student->admission_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $student->blood_group }}</td>
                                                <td>{{ $student->height }}</td>
                                                <td>{{ $student->weight }}</td>
                                                <td>{{ $student->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($student->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', $student->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('admin.student.delete', $student->id) }}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float:right">
                                    {!! $students->appends(Request::except('page'))->links() !!}
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
