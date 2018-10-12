@extends('layouts.app')

@section('content')
    <img src="/storage/file/{{$subject->cover_image}}" style="height: 100%; width: 100%; object-fit: contain" alt="{{$subject->cover_image}}">   
    <hr>
    <div class="row">
        <div class="col-md-3">
            <a href="/subject/visit/{{$subject->id}}">
                <img src="/storage/file/{{$subject->image}}" height="200" width="200" alt="{{$subject->cover_image}}">   
            </a>
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
    <hr>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            @if ($subject->open ==1 || Auth::user()->id == $subject->user_id)
                <div>
                    {!! Form::open(['action' => 'PostsController@postAdding', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{Form::hidden("subjectID", $subject->id)}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{__('messages.title')}}</span>
                            </div>
                            {{Form::text("postTitle", "",['class'=>'form-control', "placeholer" => __('messages.title')])}}
                            {{Form::submit(__("messages.post"), ['class' => 'btn btn-outline-primary'])}}
                        </div>
                        {{Form::textarea("postContent", "",['class'=>'form-control', "rows"=> "4", "placeholder" => __('messages.goodDayToWrite')])}}
                        {{Form::file('file1')}}{{Form::file('file2')}}
                    {!! Form::close() !!}
                    <hr>
                </div>    
            @endif
            @foreach ($posts as $post)
                <div class="card bg-muted">
                    <div class="card-header">
                        @if (Auth::user()->id == $subject->user_id)
                            <a href="/post/edit/{{$post->id}}" class="btn btn-primary">{{__("messages.edit")}}</a> 
                        @endif
                        <a href="/subject/visit/{{$subject->id}}">
                            <img src="/storage/file/{{$subject->image}}" height="35" width="35" alt="{{$subject->cover_image}}">
                            <b class="text-muted">{{$subject->name}}</b>
                        </a>
                        ->
                        <a href="/user/view/{{$post->user_id}}">
                            <img src="/storage/file/{{$post->user_image}}" height="35" width="35" alt="{{$post->user_image}}">
                            <b class="text-muted">{{$post->user_name}}</b>
                        </a>
                        ->
                        <a href="/post/view/{{$post->id}}"><b>{{$post->title}}</b></a>
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
                        <div class="row">
                            <div class="col-md-10">
                                <a href="/upvote/1/{{$post->id}}">
                                    <span>
                                        @if (isset($postsLikedByUser[$post->id]))   
                                            <img src="/storage/icon/liked.svg" alt="upvote" width="25" height="25">
                                        @else
                                            <img src="/storage/icon/notLikeYet.svg" alt="upvote" width="25" height="25">
                                        @endif
                                        @if (isset($postsLikeCount[$post->id]))
                                            <b>{{$postsLikeCount[$post->id]}}</b>
                                        @else
                                            <b>0</b>
                                        @endif
                                    </span>
                                </a>
                                <a href="/post/view/{{$post->id}}">
                                    <span>
                                        <img src="/storage/icon/comment.svg" alt="upvote" width="25" height="25">
                                        @if (isset($postsCommentCount[$post->id]))
                                            <b>{{$postsCommentCount[$post->id]}}</b>
                                        @else
                                            <b>0</b>
                                        @endif
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a href="/post/view/{{$post->id}}" class="btn btn-primary btn-block">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div><br>
            @endforeach
        </div>
    </div>
@endsection
