@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <!--Open nav/-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#today">Today events</a></li>
                        <li><a data-toggle="tab" href="#nextFive">Events for the next 5 days</a></li>
                        <li><a data-toggle="tab" href="#all">All events</a></li>
                    </ul>
                    
                    <div class="tab-content">

                        <!--Open Today events-->
                        <div id="today" class="tab-pane fade in active">
                            <h3>Today events</h3>
                            <a href="" class="btn btn-warning">Import CSV</a>
                            
                            <table class="table table-striped table-inverse table-responsive" id="todayEvents">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventsToday as $eventToday)
                                        <tr>
                                            <td scope="row">{{$eventToday->title}}</td>
                                            <td>{{$eventToday->description}}</td>
                                            <td>{{$eventToday->start_date}} at {{$eventToday->start_time}}</td>
                                            <td>{{$eventToday->end_date}} at {{$eventToday->end_time}}</td>
                                            <td>
                                                <a href="{{ route('events.edit', $eventToday->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('events.destroy', $eventToday->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Close Today events-->

                        <!--Open Events for the next 5 days-->
                        <div id="nextFive" class="tab-pane fade">
                            <h3>Events for the next 5 days</h3>
                            <a href="" class="btn btn-warning">Import CSV</a>

                            <table class="table table-striped table-inverse table-responsive" id="nextFiveEvents">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventsNextFiveDays as $eventNextFiveDays)
                                        <tr>
                                            <td scope="row">{{$eventNextFiveDays->title}}</td>
                                            <td>{{$eventNextFiveDays->description}}</td>
                                            <td>{{$eventNextFiveDays->start_date}} at {{$eventNextFiveDays->start_time}}</td>
                                            <td>{{$eventNextFiveDays->end_date}} at {{$eventNextFiveDays->end_time}}</td>
                                            <td>
                                                <a href="{{ route('events.edit', $eventNextFiveDays->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('events.destroy', $eventNextFiveDays->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--OPen All events-->
                        <div id="all" class="tab-pane fade">
                            <h3>All events</h3>
                            <a href="" class="btn btn-warning">Import CSV</a>

                            <table class="table table-striped table-inverse table-responsive" id="allEvents">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventsAll as $eventAll)
                                        <tr>
                                            <td scope="row">{{$eventAll->title}}</td>
                                            <td>{{$eventAll->description}}</td>
                                            <td>{{$eventAll->start_date}} at {{$eventAll->start_time}}</td>
                                            <td>{{$eventAll->end_date}} at {{$eventAll->end_time}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-success eventSend" data-toggle="modal" data-target="#newSend" data-title='{{$eventAll->title}}' data-description='{{$eventAll->description}}' data-startdate='{{$eventAll->start_date}}' data-starttime='{{$eventAll->start_time}}' data-enddate='{{$eventAll->end_date}}' data-endtime='{{$eventAll->end_time}}' >
                                                    Send invitation
                                                </button>
                                                <a href="{{ route('events.edit', $eventAll->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('events.destroy', $eventAll->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Close All events-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('events.modals.modalNewSend')
@endsection

@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href=" {{ asset('vendor/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('scripts')
<script>
// Edit a post
$(document).on('click', '.eventSend', function() {
            $('#titleSend').text($(this).data('title'));
            $('#descriptionSend').text($(this).data('description'));
            $('#startDateSend').text($(this).data('startdate'));
            $('#startTimeSend').text($(this).data('starttime'));
            $('#endDateSend').text($(this).data('enddate'));
            $('#endTimeSend').text($(this).data('endtime'));
        });
</script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('custom/js/datatables.js')}}"></script>



<script>

        $('.modal-footer').on('click', '.sendEmail', function() {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('events.send')}}",
                        data: {
                            '_token'        : $('input[name=_token]').val(),
                            'title'         : $(this).data('title'),
                            'description'   : $(this).data('description'),
                            'start_date'    : $(this).data('startdate'),
                            'start_time'    : $(this).data('starttime'),
                            'end_date'      : $(this).data('enddate'),
                            'end_time'      : $(this).data('endtime'),
                            'email'         : $('input[name=email]').val(),
                            'email_body'    : $('textarea[name=emailBody]').val(), 
                        },
                        success: function(data){
                            if((data.errors)) {
                                $('.error').removeClass('hidden');
                                $('.error').text(data.errors.title);

                            }else{
                                $('.error').remove();
                            }
                        }
                        
                    });
                });   
        </script>
@endpush