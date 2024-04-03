@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Student</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.student.add.perform') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">First Name</label><span style="color:red;">*</span>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter First Name" required>
                                <div style="color: red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label><span style="color:red;">*</span>
                                <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                <div style="color: red">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="admission_number">Admission Number</label><span style="color:red;">*</span>
                                <input type="text" id="admission_number" class="form-control" name="admission_number" value="{{ old('admission_number') }}" placeholder="Enter Admission Number" required>
                                <div style="color: red">{{ $errors->first('admission_number') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="roll_number">Roll Number</label><span style="color:red;">*</span>
                                <input type="text" id="roll_number" class="form-control" name="roll_number" value="{{ old('roll_number') }}" placeholder="Enter Roll Number" required>
                                <div style="color: red">{{ $errors->first('roll_number') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="class_id">Class</label><span style="color:red;">*</span>
                                <select name="classe_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($getClassAssigns as $getClassAssign)
                                        <option {{ (old('classe_id') == $getClassAssign->id)?'selected':'' }} value="{{ $getClassAssign->id }}">{{ $getClassAssign->name }}</option>
                                    @endforeach
                                </select>
                                <div style="color: red">{{ $errors->first('classe_id') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label><span style="color:red;">*</span>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option {{ (old('gender') == 'Male')?'selected':'' }} value="Male">Male</option>
                                    <option {{ (old('gender') == 'Female')?'selected':'' }} value="Female">Female</option>
                                    <option {{ (old('gender') == 'Other')?'selected':'' }} value="Other">Other</option>
                                </select>
                                <div style="color: red">{{ $errors->first('gender') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Date of Birth</label><span style="color:red;">*</span>
                                <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="caste">Caste</label><span style="color:red;">*</span>
                                <input type="text" id="caste" class="form-control" name="caste" value="{{ old('caste') }}" placeholder="Enter Caste" required>
                                <div style="color: red">{{ $errors->first('caste') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="religion">Religion</label><span style="color:red;">*</span>
                                <input type="text" id="religion" class="form-control" name="religion" value="{{ old('religion') }}" placeholder="Enter Religion" required>
                                <div style="color: red">{{ $errors->first('religion') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile_number">Mobile Number</label><span style="color:red;">*</span>
                                <input type="text" id="mobile_number" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number" required>
                                <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="admission_date">Admission Date</label><span style="color:red;">*</span>
                                <input type="date" id="admission_date" class="form-control" name="admission_date" value="{{ old('admission_date') }}" placeholder="Enter Admission Date" required>
                                <div style="color: red">{{ $errors->first('admission_date') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="profile_pic">Profile Pic</label><span style="color:red;">*</span>
                                <input type="file" id="profile_pic" class="form-control" name="profile_pic"  required>
                                <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Blood_group">Blood group</label><span style="color:red;">*</span>
                                <input type="text" id="Blood_group" class="form-control" name="blood_group" value="{{ old('blood_group') }}" placeholder="Enter Blood Group" required>
                                <div style="color: red">{{ $errors->first('blood_group') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="height">Height</label><span style="color:red;">*</span>
                                <input type="text" id="height" class="form-control" name="height" value="{{ old('height') }}" placeholder="Enter Height" required>
                                <div style="color: red">{{ $errors->first('height') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="weight">Weight</label><span style="color:red;">*</span>
                                <input type="text" id="weight" class="form-control" name="weight" value="{{ old('weight') }}" placeholder="Enter Weight" required>
                                <div style="color: red">{{ $errors->first('weight') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label><span style="color:red;">*</span>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option {{ (old('status') == 0)?'selected':'' }} value="0">Active</option>
                                    <option {{ (old('status') == 1)?'selected':'' }} value="1">Inactive</option>
                                </select>
                                <div style="color: red">{{ $errors->first('status') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email address</label><span style="color:red;">*</span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                                <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label><span style="color:red;">*</span>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                <div style="color: red">{{ $errors->first('password') }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
