@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Old Password</label>
                            <input type="password" class="form-control" name="old_password"  placeholder="Enter Old Password" required>
                        </div>
                        <div class="form-group">
                            <label for="name">New Password</label>
                            <input type="password" class="form-control" name="new_password"  placeholder="Enter New Password" required>
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
