@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if ($subjectType == 0)
                <h3>{{__("messages.schoolSubject")}}</h3>
            @elseif ($subjectType == 1)
                <h3>{{__("messages.projectSubject")}}</h3>
            @else 
                <h3>{{__("messages.userSubject")}}</h3>
            @endif
        </div>
        <div class="col-md-4">
            @if ($subjectType == 1)
                <a href="/subject/add/1" class="btn btn-primary btn-block">{{__("messages.addNewProject")}}</a>
            @elseif(Auth::user()->type == 3)
                <a href="/subject/add/0" class="btn btn-primary btn-block">{{__("messages.addNewSubject")}}</a>
            @endif
        </div>
    </div><hr>
    <div class="card-columns">
        @foreach ($subjects as $subject)
            <div class="card bg-light">
                <div class="card-header">
                    <a href="/subject/visit/{{$subject->id}}"><b>{{$subject->name}}</b></a><br>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/subject/visit/{{$subject->id}}">
                                <img src="/storage/file/{{$subject->image}}" alt="{{$subject->image}}" width="100" height="100">
                            </a>
                        </div>
                        <div class="col-md-8">
                            {{$subject->quote}}
                        </div> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
