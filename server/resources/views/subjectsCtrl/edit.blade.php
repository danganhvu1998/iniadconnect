@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'SubjectsController@subjectEdittingInfo', 'method' => 'POST']) !!}
        {{Form::hidden("subjectID", $subject->id)}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.name')}}</span>
            </div>
            {{Form::text("subjectName", $subject->name,['class'=>'form-control'])}}
            {{Form::select('subjectOpen', [0 => __('messages.closeSubject'), 1 => __('messages.openSubject')], $subject->open)}}
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.quote')}}</span>
            </div>
            {{Form::text("subjectQuote", $subject->quote,['class'=>'form-control'])}}
        </div>
        {{Form::submit('Save', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}

        <!--Change Image--> <hr>
    {!! Form::open(['action' => 'SubjectsController@subjectEdittingImage', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden("subjectID", $subject->id)}}
        <b>{{__('messages.subjectImage')}}</b><br>
        <img src="/storage/file/{{$subject->image}}" height="100" alt="{{$subject->image}}">   
        {{Form::file('file')}}
        {{Form::submit('UPLOAD (Maximum 2MB)', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}

    <!--Change Cover Image--> <hr>
    {!! Form::open(['action' => 'SubjectsController@subjectEdittingCoverImage', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::hidden("subjectID", $subject->id)}}
        <b>{{__('messages.subjectCoverImage')}}</b><br>
        <img src="/storage/file/{{$subject->cover_image}}" height="100" alt="{{$subject->cover_image}}">   
        {{Form::file('file')}}
    {{Form::submit('UPLOAD (Maximum 2MB)', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
