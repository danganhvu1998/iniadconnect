@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if ($subjectType == 0)
                <h3>{{__("messages.choolSubject")}}</h3>
            @elseif ($subjectType == 1)
                <h3>{{__("messages.projectSubject")}}</h3>
            @else 
                <h3>{{__("messages.userSubject")}}</h3>
            @endif
        </div>
        <div class="col-md-4">
            @if ($subjectType == 1)
                <a href="/subject/add/1" class="btn btn-primary btn-block">ADD YOUR NEW PROJECT</a>
            @endif
        </div>
    </div><hr>
    <div class="card-columns">
        @foreach ($subjects as $subject)
            <div class="card-header">
                <a href="/subject/edit/{{$subject->id}}"><b>{{$subject->name}}</b></a><br>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="/storage/file/{{$subject->image}}" alt="{{$subject->image}}" width="150" height="150">
                    </div>
                    <div class="col-md-8">
                        {{$subject->quote}}
                    </div> 
                </div>
            </div>
        @endforeach
    </div>
@endsection
