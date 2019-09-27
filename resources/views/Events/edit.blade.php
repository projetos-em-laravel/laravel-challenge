@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('events.update', $event->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $event->title) }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="description" class="form-control" name="description" value="{{ old('description', $event->description) }}" required>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('start_datetime') ? ' has-error' : '' }}">
                            <label for="start_datetime" class="col-md-4 control-label">Start datetime</label>

                            <div class="col-md-6">
                                <input id="start_datetime" type="datetime-local" class="form-control" name="start_datetime" value="{{ old('start_datetime', $event->start_datetime) }}" required>

                                @if ($errors->has('start_datetime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_datetime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end_datetime') ? ' has-error' : '' }}">
                            <label for="end_datetime" class="col-md-4 control-label">End datetime</label>

                            <div class="col-md-6">
                                <input id="end_datetime" type="datetime-local" class="form-control" name="end_datetime" value="{{ old('end_datetime', $event->end_datetime) }}" required>

                                @if ($errors->has('end_datetime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_datetime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
