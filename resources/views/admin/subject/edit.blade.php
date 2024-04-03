@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Subject</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/subject/update/'. $subject->id) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" name="name" value="{{ old('name', $subject->name) }}" placeholder="Enter Subject Name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject Type</label>
                            <select class="form-control" name="type" required>
                                <option value="">Choose One</option>
                                <option value="Theory" @selected($subject->type=='Theory')>Theory</option>
                                <option value="Practical" @selected($subject->type=='Practical')>Practical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">Choose One</option>
                                <option value="0" @selected($subject->status == 0)>Active</option>
                                <option value="1" @selected($subject->status == 1)>Incctive</option>
                            </select>
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
