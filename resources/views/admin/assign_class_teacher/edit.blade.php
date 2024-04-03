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
                    <form action="{{ route('admin.assign_class_teacher.update', $class_teacher->id) }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Class Name</label>
                                <select class="form-control" name="classe_id" required>
                                    <option value="">Choose One</option>
                                    @foreach ($getClassAssign as $classe)
                                        <option value="{{ $classe->id }}" @selected($classe->id == $class_teacher->classe_id)>{{ $classe->name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group">
                                <label for="name">Teacher Name</label>
                                @foreach ($teachers as $teacher)
                                    @php
                                        $checked = '';
                                    @endphp
                                    @foreach ($getAssignTeacherIDs as $getAssignTeacherID)
                                        @if ($teacher->id == $getAssignTeacherID->teacher_id)
                                           @php               
                                               $checked = "checked"; 
                                           @endphp
                                        @endif
                                    @endforeach
                                    <div>
                                        <input {{ $checked }} type="checkbox" value="{{ $teacher->id }}"
                                            name="teacher_id[]"> {{ $teacher->name }}
                                    </div>
                                @endforeach 
                            </div>
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Choose One</option>
                                    <option value="0" @selected($class_teacher->status == 0)>Active</option>
                                    <option value="1" @selected($class_teacher->status == 1)>Inactive</option>
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
