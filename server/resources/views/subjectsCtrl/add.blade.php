@extends('layouts.admin')

@section('content')
    {!! Form::open(['action' => 'SubjectsController@subjectAdding', 'method' => 'POST']) !!}
        {{Form::hidden("subjectType", $subjectType)}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.name')}}</span>
            </div>
            {{Form::text("subjectName", "",['class'=>'form-control'])}}
            {{Form::select('subjectOpen', [0 => __('messages.closeSubject'), 1 => __('messages.openSubject')])}}
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">{{__('messages.quote')}}</span>
            </div>
            {{Form::text("subjectQuote", "",['class'=>'form-control'])}}
        </div>
        {{Form::submit('Add', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
