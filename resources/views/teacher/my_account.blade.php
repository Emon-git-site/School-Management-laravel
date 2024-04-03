@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">My Account</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('teacher.account.update', $teacher->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">First Name</label><span style="color:red;">*</span>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $teacher->name) }}" placeholder="Enter First Name" required>
                                <div style="color: red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label><span style="color:red;">*</span>
                                <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name', $teacher->last_name) }}" placeholder="Enter Last Name" required>
                                <div style="color: red">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address">Current Address</label><span style="color:red;">*</span>
                                <input type="text" id="address" class="form-control" name="address" value="{{ old('address', $teacher->address) }}" placeholder="Enter Current Address" required>
                                <div style="color: red">{{ $errors->first('address') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="permanent_address">Permanent Address</label><span style="color:red;">*</span>
                                <input type="text" id="permanent_address" class="form-control" name="permanent_address" value="{{ old('permanent_address', $teacher->permanent_address) }}" placeholder="Enter Permanent Address" required>
                                <div style="color: red">{{ $errors->first('permanent_address') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Date of Birth</label><span style="color:red;">*</span>
                                <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $teacher->date_of_birth) }}" required>
                                <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label><span style="color:red;">*</span>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option {{ (old('gender', $teacher->gender) == 'Male')?'selected':'' }} value="Male">Male</option>
                                    <option {{ (old('gender', $teacher->gender) == 'Female')?'selected':'' }} value="Female">Female</option>
                                    <option {{ (old('gender', $teacher->gender) == 'Other')?'selected':'' }} value="Other">Other</option>
                                </select>
                                <div style="color: red">{{ $errors->first('gender') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="marital_status">Marital Status</label><span style="color:red;">*</span>
                                <input type="text" id="marital_status" class="form-control" name="marital_status" value="{{ old('marital_status', $teacher->marital_status) }}" placeholder="Enter marital_status" required>
                                <div style="color: red">{{ $errors->first('marital_status') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile_number">Mobile Number</label><span style="color:red;">*</span>
                                <input type="text" id="mobile_number" class="form-control" name="mobile_number" value="{{ old('mobile_number', $teacher->mobile_number) }}" placeholder="Enter Mobile Number" required>
                                <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email address</label><span style="color:red;">*</span>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $teacher->email) }}" placeholder="Enter email Address" required>
                                <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="profile_pic">Profile Pic</label><span style="color:red;">*</span>
                                <input type="file" id="profile_pic" class="form-control" name="profile_pic">
                                <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                @if (!empty($teacher->getProfile()))
                                <img src="{{ $teacher->getProfile() }}" style="width:100px">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="work_experience">Work Exprience</label><span style="color:red;">*</span>
                                <input type="text" id="work_experience" class="form-control" name="work_experience" value="{{ old('work_experience', $teacher->work_experience) }}" placeholder="Enter Work Experience" required>
                                <div style="color: red">{{ $errors->first('work_experience') }}</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="qualification">Qualification</label><span style="color:red;">*</span>
                                <input type="text" id="qualification" class="form-control" name="qualification" value="{{ old('qualification', $teacher->qualification) }}" placeholder="Enter qualification" required>
                                <div style="color: red">{{ $errors->first('qualification') }}</div>
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
