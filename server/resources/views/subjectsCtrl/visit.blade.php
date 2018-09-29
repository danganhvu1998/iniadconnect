@extends('layouts.app')

@section('content')
    <img src="/storage/file/{{$subject->cover_image}}" style="height: 100%; width: 100%; object-fit: contain" alt="{{$subject->cover_image}}">   
    <hr>
    <div class="row">
        <div class="col-md-3">
            <img src="/storage/file/{{$subject->image}}" height="200" width="200" alt="{{$subject->cover_image}}">   
        </div>
        <div class="col-md-9">
            <b class="text-primary">{{$subject->name}} </b>
            「 {{$subject->quote}} 」
            <hr>
            @if (Auth::user()->id == $subject->user_id)
                <div class="row">
                    <div class="col-md-4">
                        <a href="/subject/edit/{{$subject->id}}" class="btn btn-block btn-primary">{{__("messages.editSubject")}}</a>
                        <a href="" class="btn btn-block btn-primary">{{__("messages.aboutUs")}}</a>
                        <a href="" class="btn btn-block btn-primary">{{__("messages.donate")}}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
