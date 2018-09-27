@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3>Admin Users Controller</h3>
        </div>
        <div class="col-md-7">
            <div class="text-center btn-group">
                <a href="/admin/user/view/1" class="btn btn-primary">Student</a>
                <a href="/admin/user/view/2" class="btn btn-primary">Teacher</a>
                <a href="/admin/user/view/0" class="btn btn-primary">Pending</a>
                <a href="/admin/user/view/-1" class="btn btn-primary">Conflict</a>
                <a href="/admin/user/view/-2" class="btn btn-primary">Banned</a>
            </div>
        </div>
    </div><br>
    @foreach ($users as $user)
        <div class="card bg-light">
            <div class="row text-center">
                <div class="col-md-2">
                    <img src="/storage/file/{{$user->image}}" alt="{{$user->image}}" height="100" width="100">
                </div>
                <div class="col-md-3">
                    <strong>{{$user->name}}</strong><br>
                    {{$user->email}}<br>
                </div>
                <div class="col-md-3">
                    <img src="/storage/file/{{$user->card_image}}" alt="{{$user->card_image}}" height="100">
                </div>
                <div class="col-md-4">
                    <div class="btn-group btn-block">
                        <a href="/storage/file/{{$user->card_image}}" class="btn btn-secondary">View Card</a>
                        <a href="/admin/user/confirm/1/{{$user->id}}" class="btn btn-primary">Student</a>
                        <a href="/admin/user/confirm/2/{{$user->id}}" class="btn btn-success">Teacher</a>
                    </div>
                    <div class="btn-group btn-block">
                        <a href="/admin/user/reset_password/{{$user->id}}" class="btn btn-warning">Reset Password</a>
                        <a href="/admin/user/confirm/-1/{{$user->id}}" class="btn btn-danger">Conflict</a>
                        <a href="/admin/user/confirm/-2/{{$user->id}}" class="btn btn-dark">Ban</a>
                    </div>
                </div>
            </div>
        </div><br>
    @endforeach
@endsection
