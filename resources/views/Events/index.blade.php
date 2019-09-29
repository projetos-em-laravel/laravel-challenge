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
                                        <tr class="{{'itemEvent'.$eventToday->id}}">
                                            <td scope="row">{{$eventToday->title}}</td>
                                            <td>{{$eventToday->description}}</td>
                                            <td>{{$eventToday->start_date}} at {{$eventToday->start_time}}</td>
                                            <td>{{$eventToday->end_date}} at {{$eventToday->end_time}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-success eventSend" data-toggle="modal" data-target="#newSend" data-title='{{$eventToday->title}}' data-description='{{$eventToday->description}}' data-startdate='{{$eventToday->start_date}}' data-starttime='{{$eventToday->start_time}}' data-enddate='{{$eventToday->end_date}}' data-endtime='{{$eventToday->end_time}}' >
                                                    Send invitation
                                                </button>
                                                <a href="{{ route('events.edit', $eventToday->id) }}" class="btn btn-primary">Edit</a>
                                                <button type="button" class="btn btn-danger deleteEventForModal" data-toggle="modal" data-target="#deleteEvent" data-id='{{$eventToday->id}}' data-title='{{$eventToday->title}}'>
                                                    Delete
                                                </button>
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
                                        <tr class="{{'itemEvent'.$eventNextFiveDays->id}}">
                                            <td scope="row">{{$eventNextFiveDays->title}}</td>
                                            <td>{{$eventNextFiveDays->description}}</td>
                                            <td>{{$eventNextFiveDays->start_date}} at {{$eventNextFiveDays->start_time}}</td>
                                            <td>{{$eventNextFiveDays->end_date}} at {{$eventNextFiveDays->end_time}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-success eventSend" data-toggle="modal" data-target="#newSend" data-title='{{$eventNextFiveDays->title}}' data-description='{{$eventNextFiveDays->description}}' data-startdate='{{$eventNextFiveDays->start_date}}' data-starttime='{{$eventNextFiveDays->start_time}}' data-enddate='{{$eventNextFiveDays->end_date}}' data-endtime='{{$eventNextFiveDays->end_time}}' >
                                                    Send invitation
                                                </button>
                                                <a href="{{ route('events.edit', $eventNextFiveDays->id) }}" class="btn btn-primary">Edit</a>
                                                <button type="button" class="btn btn-danger deleteEventForModal" data-toggle="modal" data-target="#deleteEvent" data-id='{{$eventNextFiveDays->id}}' data-title='{{$eventNextFiveDays->title}}'>
                                                    Delete
                                                </button>
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
                                        <tr class="{{'itemEvent'.$eventAll->id}}">
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
                                                <button type="button" class="btn btn-danger deleteEventForModal" data-toggle="modal" data-target="#deleteEvent" data-id='{{$eventAll->id}}' data-title='{{$eventAll->title}}'>
                                                    Delete
                                                </button>                                            
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
@include('events.modals.modalDeleteEvent')
@endsection

@push('css')
<!--Datatable need this link extern-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href=" {{ asset('vendor/css/dataTables.bootstrap.min.css') }}">
@endpush

@push('scripts')
<!-- Datatables  -->
<script type="text/javascript" src="{{ asset('vendor/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('custom/js/datatables.js')}}"></script>

<!-- Send Inite email-->
<script type="text/javascript" src="{{ asset('custom/js/sendEmail.js') }}"></script>
        
<script>
    var id;
 $(document).on('click', '.deleteEventForModal', function() { 
    
        $('#eventId').text($(this).data('id'));
        $('#title').text($(this).data('title'));
        id = $(this).data('id');
        
});

$('.modal-footer').on('click', '.deleteEventInModal', function() {
        
        
        $.ajax({
            type: 'DELETE',
            url: '/events/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                $('.itemEvent' + data['id']).remove();
            }
        });
    });
</script>
@endpush