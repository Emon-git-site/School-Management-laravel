@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Student</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('student.account.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">First Name</label><span style="color:red;">*</span>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $student->name) }}" placeholder="Enter First Name" required>
                                <div style="color: red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label><span style="color:red;">*</span>
                                <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name', $student->last_name) }}" placeholder="Enter Last Name" required>
                                <div style="color: red">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label><span style="color:red;">*</span>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option {{ (old('gender', $student->gender) == 'Male')?'selected':'' }} value="Male">Male</option>
                                    <option {{ (old('gender', $student->gender) == 'Female')?'selected':'' }} value="Female">Female</option>
                                    <option {{ (old('gender', $student->gender) == 'Other')?'selected':'' }} value="Other">Other</option>
                                </select>
                                <div style="color: red">{{ $errors->first('gender') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="profile_pic">Profile Pic</label><span style="color:red;">*</span>
                                <input type="file" id="profile_pic" class="form-control" name="profile_pic" >
                                <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                @if (!empty($student->getProfile()))
                                <img src="{{ $student->getProfile() }}" style="width:100px">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Date of Birth</label><span style="color:red;">*</span>
                                <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
                                <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="caste">Caste</label><span style="color:red;">*</span>
                                <input type="text" id="caste" class="form-control" name="caste" value="{{ old('caste', $student->caste) }}" placeholder="Enter Caste" required>
                                <div style="color: red">{{ $errors->first('caste') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="religion">Religion</label><span style="color:red;">*</span>
                                <input type="text" id="religion" class="form-control" name="religion" value="{{ old('religion', $student->religion) }}" placeholder="Enter Religion" required>
                                <div style="color: red">{{ $errors->first('religion') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile_number">Mobile Number</label><span style="color:red;">*</span>
                                <input type="text" id="mobile_number" class="form-control" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number) }}" placeholder="Enter Mobile Number" required>
                                <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Blood_group">Blood group</label><span style="color:red;">*</span>
                                <input type="text" id="Blood_group" class="form-control" name="blood_group" value="{{ old('blood_group', $student->blood_group) }}" placeholder="Enter Blood Group" required>
                                <div style="color: red">{{ $errors->first('blood_group') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="height">Height</label><span style="color:red;">*</span>
                                <input type="text" id="height" class="form-control" name="height" value="{{ old('height', $student->height) }}" placeholder="Enter Height" required>
                                <div style="color: red">{{ $errors->first('height') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="weight">Weight</label><span style="color:red;">*</span>
                                <input type="text" id="weight" class="form-control" name="weight" value="{{ old('weight', $student->weight) }}" placeholder="Enter Weight" required>
                                <div style="color: red">{{ $errors->first('weight') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email address</label><span style="color:red;">*</span>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $student->email) }}" placeholder="Enter email" required>
                                <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
