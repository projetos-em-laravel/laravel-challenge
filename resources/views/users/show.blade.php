@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile</div>

                <div class="panel-body">
                    <ul>
                        <li class="list-group-item"><strong>Name:</strong> {{$user->name}}</li>
                        <li class="list-group-item"><strong>email:</strong> {{$user->email}}</li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Profile edit</a>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
