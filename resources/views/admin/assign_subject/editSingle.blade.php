@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Assign Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                    <form action="{{ url('admin/assign-subject/update-single/'.$classSubject->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Class Name</label>
                                <select class="form-control" name="class_id" required>
                                    <option value="">Choose One</option>
                                    @foreach ($getClassAssigns as $getClassAssign)
                                        <option value="{{ $getClassAssign->id }}" @selected($getClassAssign->id == $classSubject->classe_id)>{{ $getClassAssign->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Subject Name</label>
                                <select class="form-control" name="subject_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($getSubjectAssigns as $getSubjectAssign)
                                        <option value="{{ $getSubjectAssign->id }}" @selected($getSubjectAssign->id == $classSubject->subject_id)>{{ $getSubjectAssign->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Choose One</option>
                                    <option value="0" @selected($classSubject->status == 0)>Active</option>
                                    <option value="1" @selected($classSubject->status == 1)>Inactive</option>
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
