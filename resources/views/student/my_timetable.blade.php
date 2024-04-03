@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Timetable</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @foreach ($class_schedules as $class_schedule)                    
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="color: rgb(103, 235, 217);">{{ $class_schedule['subject_name'] }}</h3>
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
                                @foreach ($class_schedule['week'] as $week)
                                    <tr>
                                        <td>{{ $week['week_name'] }}</td>
                                        <td>{{ !empty($week['start_time'])? date('h:i A', strtotime($week['start_time'])): '' }}</td>
                                        <td>{{ !empty($week['end_time'])? date('h:i A', strtotime($week['end_time'])): '' }}</td>
                                        <td>{{ $week['room_number'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                @endforeach
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
