@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class Timetable List </h1>
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
                        <h3 class="card-title">Search Class Timetable</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row p-1">
                                <div class="form-group  col-md-3">
                                    <select class="form-control getClass" name="class_id" required>
                                        <option value="">Select Class</option>
                                        @foreach ($getClass as $class)
                                            <option {{ Request('class_id') == $class->id ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-md-3">
                                    <select class="form-control getSubject" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @if (!empty($getSubject))
                                            @foreach ($getSubject as $subject)
                                                <option
                                                    {{ Request('subject_id') == $subject->subject_id ? 'selected' : '' }}
                                                    value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3 d-flex align-items-center">
                                    <button class="btn btn-primary btn-outlook mr-2" type="submit">Search</button>
                                    <a href="{{ route('admin.class_timetable.list') }}" class="btn btn-success btn-outlook"
                                        role="button">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>

                @if(!empty(Request('class_id')) && !empty(Request('subject_id')) )
                <form action="{{ route('admin.class_timetable.add') }}" method="post">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{ Request('subject_id') }}">
                    <input type="hidden" name="class_id" value="{{ Request('class_id') }}">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Class Timetable</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr> 
                                    <th>week</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($weeks as $week)
                                    <tr>
                                        <th>
                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $week['week_id'] }}">
                                            {{ $week['week_name'] }}
                                        </th>
                                        <td>
                                            <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $week['start_time'] }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $week['end_time'] }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" style="width: 200px" name="timetable[{{ $i }}][room_number]" value="{{ $week['room_number'] }}" class="form-control">
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center; padding: 20px">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
                @endif
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.getClass').change(function(e) {
                e.preventDefault();
                var class_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.class_timetable.get_subject') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        class_id: class_id,
                    },
                    dataType: "json",
                    success: function(response) {
                        $('.getSubject').html(response.html);
                    },

                });
            });
        });
    </script>
@endsection
