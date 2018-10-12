@extends('layouts.app')

@section('content')
    <div>
        <h3>{{__("messages.edit")}}</h3>
        {!! Form::open(['action' => 'PostsController@postEditing', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{Form::hidden("postID", $post->id)}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{__('messages.title')}}</span>
                </div>
                {{Form::text("postTitle", $post->title,['class'=>'form-control', "placeholer" => __('messages.title')])}}
                {{Form::submit(__('messages.edit'), ['class' => 'btn btn-outline-primary'])}}
            </div>
            {{Form::textarea("postContent", $post->content,['class'=>'form-control', "rows"=> "4", "placeholder" => __('messages.goodDayToWrite')])}}
            {{Form::file('file1')}}{{Form::file('file2')}}
        {!! Form::close() !!}
        <hr>
    </div>
    <div>
        <h3>{{__("messages.preview")}}</h3><br><br>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="card bg-muted">
                    <div class="card-header">
                        <b>{{$post->title}}</b>
                    </div>
                    <div class="card-body">
                        {!!$post->content!!}<hr>
                        <div class="row">
                            @if (isset($post->image) and isset($post->more_image))
                                <div class="col-md-6">
                                    <img src="/storage/file/{{$post->image}}" width="100%" alt="{{$post->image}}">   
                                </div>
                                <div class="col-md-6">
                                    <img src="/storage/file/{{$post->more_image}}" width="100%" alt="{{$post->more_image}}">   
                                </div>  
                            @else
                                <div class="col-md-12">
                                    <img src="/storage/file/{{$post->image}}" width="100%" alt="">   
                                    <img src="/storage/file/{{$post->more_image}}" width="100%" alt="">   
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        Like, Gold and Comment are coming soon!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection