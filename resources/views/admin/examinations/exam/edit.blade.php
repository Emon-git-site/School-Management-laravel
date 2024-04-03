@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Exam</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.examinations.exam.update', $getExamRecord->id) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Exam Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $getExamRecord->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Note</label>
                            <textarea class="form-control" name="note" cols="30" rows="5">{{ old('note', $getExamRecord->note) }}</textarea>
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
