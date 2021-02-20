@extends('layouts.app')

@section('title', 'Do Exam')

@section('styles')
    <link rel="stylesheet" href="{{asset('package/TimeCircles.css')}}">
@endsection

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Exam Session List
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('register-session')}}" class="kt-subheader__breadcrumbs-link">
            Exam Session List
        </a>
    </div>
@endsection

@section('content')

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Exam Title</th>
                <th>Session Code</th>
                <th>Scheduled At</th>
                <th>Exam Duration</th>
                <th>Register Duration</th>
                <th>Questions Type</th>
                <th>Total Questions</th>
                <th>Session Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exam_session as $key => $item)
                    {{-- @php
                        dd($item);exit;
                    @endphp --}}
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item['examSession']['exam']['exam_title']}}</td>
                    <td>{{$item['examSession']['exam_session_code']}}</td>
                    <td>{{$item['examSession']['exam_datetime'] ?? '-'}}</td>
                    <td>{{isset($item['examSession']['exam_duration']) ? $item['examSession']['exam_duration'].' minutes' : '-'}}</td>
                    @if ($item['examSession']['exam_session_status'] == 'On Going')
                        <td>Registration closes in <b><span id="time">05:00</span></b> minutes!</td>
                    @else
                        <td>{{isset($item['examSession']['register_duration']) ? $item['examSession']['register_duration'].' minutes' : '-'}}</td>
                    @endif

                    <td>{{$item['examSession']['question_type']}}</td>
                    <td>{{$item['examSession']['total_question']}}</td>
                    <td>
                        @if ($item['examSession']['exam_session_status'] == 'Terminated')
                            <span class="badge badge-pill badge-danger" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @elseif($item['examSession']['exam_session_status'] == 'On Going')
                            <span class="badge badge-pill badge-success" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @else
                            <span class="badge badge-pill badge-warning" style="font-size: 1.1em">{{$item['examSession']['exam_session_status']}}</span>
                        @endif

                    </td>
                    <td>
                        @if ($item['examSession']['exam_session_status'] == 'On Going')
                            <a data-toggle='modal' data-target='register-session' type="button" class="btn btn-primary" style="color: white"><span class="flaticon-user-ok"></span> Register</a>
                        @else
                            <a data-toggle='modal' data-target='register-session' type="button" class="btn btn-light" style="color: white; background-color: #EBEDF2; border-color: #EBEDF2;" disabled><span class="flaticon-user-ok"></span> Register</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="DateCountdown" data-date="2021-01-10 9:14:00" style="width: 100%;"></div>
@endsection

@section('scripts')
    <script src="{{ asset('package/TimeCircles.js') }}"></script>

    <script>
        $(function(){
            $("#DateCountdown").TimeCircles({
                "animation": "smooth",
                "bg_width": 1.2,
                "fg_width": 0.1,
                "circle_bg_color": "#60686F",
                "time": {
                    "Days": {
                        "text": "Days",
                        "color": "#FFCC66",
                        "show": true
                    },
                    "Hours": {
                        "text": "Hours",
                        "color": "#99CCFF",
                        "show": true
                    },
                    "Minutes": {
                        "text": "Minutes",
                        "color": "#BBFFBB",
                        "show": true
                    },
                    "Seconds": {
                        "text": "Seconds",
                        "color": "#FF9999",
                        "show": true
                    }
                }
            });
        })
    </script>
@endsection
