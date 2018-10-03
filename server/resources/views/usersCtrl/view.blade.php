@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>{{$user->name}} {{__("messages.profile")}}</h3>
        </div>
        <div class="col-md-4">
            @if ($user->id == Auth::user()->id)
                <a href="/user/setting/setting" class="btn btn-block btn-primary">
                    {{__("messages.edit")}}
                </a>
            @endif
        </div>
    </div><br>
    <div class="row text-center">
        <div class="col-md-4">
            <img src="/storage/file/{{$user->image}}" alt="{{$user->image}}" height="200" width="200">
        </div>
        <div class="col-md-8">
            <b>{{$user->name}}</b><br>
            {{$user->email}}<br>
            @if ($user->language)   
                <b>English</b>
            @else
                <b>日本語</b>
            @endif
        </div>
    </div>

@endsection
