@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <a href="{{ route('events.create') }}" class="btn btn-primary">Create</a>
            </div>    
            <!--Dashboard Today events-->
            <div class="panel panel-default">
                <div class="panel-heading">Today events</div>

                <div class="panel-body">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start datetime</th>
                                <th>End datetime</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventsToday as $eventToday)
                                    <tr>
                                        <td scope="row">{{$eventToday->title}}</td>
                                        <td>{{$eventToday->description}}</td>
                                        <td>{{$eventToday->start_datetime}}</td>
                                        <td>{{$eventToday->end_datetime}}</td>
                                        <td>
                                            <a href="{{ route('events.edit', $eventToday->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('events.destroy', $eventToday->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>

            <!--Events for the next 5 days-->
            <div class="panel panel-default">
                <div class="panel-heading">Events for the next 5 days</div>

                <div class="panel-body">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start datetime</th>
                                <th>End datetime</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventsNextFiveDays as $eventNextFiveDays)
                                    <tr>
                                        <td scope="row">{{$eventNextFiveDays->title}}</td>
                                        <td>{{$eventNextFiveDays->description}}</td>
                                        <td>{{$eventNextFiveDays->start_datetime}}</td>
                                        <td>{{$eventNextFiveDays->end_datetime}}</td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>

            <!--All events-->
            <div class="panel panel-default">
                    <div class="panel-heading">All events</div>
    
                    <div class="panel-body">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Start datetime</th>
                                    <th>End datetime</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventsAll as $eventAll)
                                        <tr>
                                            <td scope="row">{{$eventAll->title}}</td>
                                            <td>{{$eventAll->description}}</td>
                                            <td>{{$eventAll->start_datetime}}</td>
                                            <td>{{$eventAll->end_datetime}}</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Edit</a>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
                
        </div>
    </div>
</div>
@endsection
