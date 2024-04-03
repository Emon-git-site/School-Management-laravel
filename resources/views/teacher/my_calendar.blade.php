@extends('layouts.app')
@section('style')
    <style type="text/css">
        .fc-daygrid-event {
            white-space: normal;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Caldendar</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ url('admin/dist/fullcalendar/index.global.js') }}"></script>

    <script type="text/javascript">
        var events = [];
        var eventId = 1;

        // @foreach ($getMyTimetable as $value)
        //     @foreach ($value['week'] as $week)
        //         events.push({
        //             title: '{{ $value['subject_name'] }}',
        //             daysOfWeek: [{{ $week['fullcalendar_day'] }}],
        //             startTime: '{{ $week['start_time'] }}',
        //             endTime: '{{ $week['end_time'] }}',
        //         });
        //     @endforeach
        // @endforeach
        // @foreach ($getExamTimetable as $valueE)
        //     @foreach ($valueE['exam'] as $exam)
        //         events.push({
        //             event_id: eventId++,
        //             title: '{{ $valueE['exam_name'] }} - {{ $exam['subject_name'] }} ({{ date('h:i A', strtotime($exam['start_time'])) }} to {{ date('h:i A', strtotime($exam['end_time'])) }})',
        //             start: '{{ $exam['exam_date'] }}',
        //             end: '{{ $exam['exam_date'] }}',
        //             color: 'silver',
        //             url: 'http://127.0.0.1:8000/student/my_exam_timetable',
        //         });
        //     @endforeach
        // @endforeach
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: '<?= date('Y-m-d') ?>',
            navLinks: true,
            editable: false,
            events: events,
        });

        calendar.render();
    </script>
@endsection
