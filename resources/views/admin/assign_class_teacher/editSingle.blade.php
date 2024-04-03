@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Assign Class Teacher</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    
                    <form action="{{ url('admin/assign_class_teacher/update-single/'.$classteacher->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Class Name</label>
                                <select class="form-control" name="classe_id" required>
                                    <option value="">Choose One</option>
                                    @foreach ($getClassAssigns as $getClassAssign)
                                        <option value="{{ $getClassAssign->id }}" @selected($getClassAssign->id == $classteacher->classe_id)>{{ $getClassAssign->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Teacher Name</label>
                                <select class="form-control" name="teacher_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @selected($teacher->id == $classteacher->teacher_id)>{{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Choose One</option>
                                    <option value="0" @selected($classteacher->status == 0)>Active</option>
                                    <option value="1" @selected($classteacher->status == 1)>Inactive</option>
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
