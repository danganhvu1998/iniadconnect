@extends('layouts.app')

@section('content')
    <div class="card bg-muted">
        <div class="card-header">
            @if (Auth::user()->id == $subject->user_id)
                <a href="/post/edit/{{$post->id}}" class="btn btn-primary">Edit</a> 
            @endif
            <a href="/subject/visit/{{$subject->id}}">
                <img src="/storage/file/{{$subject->image}}" height="35" width="35" alt="{{$subject->cover_image}}">
                <b>{{$subject->name}}</b>
            </a>
            ->
            <a href="/user/view/{{$post->user_id}}">
                <img src="/storage/file/{{$post->user_image}}" height="35" width="35" alt="{{$post->user_image}}">
                <b>{{$post->user_name}}</b>
            </a>
            ->
            <b>{{$post->title}}</b>
        </div>
        <div class="card-body">
            <p>{{$post->content}}</p><hr>
            <div class="row">
                <div class="col-md-6">
                    <img src="/storage/file/{{$post->image}}" width="100%" alt="{{$post->image}}">   
                </div>
                <div class="col-md-6">
                    <img src="/storage/file/{{$post->more_image}}" width="100%" alt="{{$post->more_image}}">   
                </div>
            </div>
            <hr>
            <span>
                <a href="/upvote/1/{{$post->id}}">
                    @if ($postLiked==1)
                        <img src="/storage/icon/liked.svg" alt="upvote" width="25" height="25">
                    @else
                        <img src="/storage/icon/notLikeYet.svg" alt="upvote" width="25" height="25">
                    @endif
                </a> 
                <b>{{$postLikeCount}}</b>
            </span>
            <span>
                <img src="/storage/icon/comment.svg" alt="comment" width="25" height="25">
                <b>{{$commentsCount}}</b>
            </span>
        </div>
        <div class="card-footer">
            {!! Form::open(['action' => 'CommentsController@commentAdding', 'method' => 'POST']) !!}
                {{Form::hidden("postID", $post->id)}}
                <div class="input-group mb-3">
                    {{Form::textarea("commentContent", "",['class'=>'form-control', "rows"=> "2", "placeholder" => __('messages.goodDayToComment')])}}
                    {{Form::submit(__('messages.comment'), ['class' => 'btn btn-outline-primary'])}}
                </div>
            {!! Form::close() !!}
            @foreach ($comments as $comment)
                <div class="row">
                    <div class="col-md-1">
                        <img src="/storage/file/{{$comment->user_image}}" height="60" width="60" alt="{{$subject->cover_image}}">
                    </div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-8">
                                <b>{{$comment->user_name}}</b>
                            </div>
                            <div class="col-md-2 text-center">
                                @if (Auth::user()->id == $comment->user_id)
                                    <a href="/comment/delete/{{$comment->id}}" class="text-danger">{{__("messages.delete")}}</a>
                                @endif
                            </div>
                            <div class="col-md-2 text-center">
                                <a href="/upvote/2/{{$comment->id}}">
                                    @if (isset($commentsLikedByUser[$comment->id]))
                                        <img src="/storage/icon/liked.svg" alt="upvote" width="25" height="25">
                                    @else
                                        <img src="/storage/icon/notLikeYet.svg" alt="upvote" width="25" height="25">
                                    @endif
                                </a> 
                                @if (isset($commentsLikeCount[$comment->id]))
                                    <b>{{$commentsLikeCount[$comment->id]}}</b>
                                @else
                                    <b>0</b>
                                @endif
                            </div>
                        </div>
                        {{$comment->content}}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
