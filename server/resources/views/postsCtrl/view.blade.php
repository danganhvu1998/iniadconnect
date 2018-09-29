@extends('layouts.app')

@section('content')
    <div class="card bg-muted">
        <div class="card-header">
            @if (Auth::user()->id == $subject->user_id)
                <a href="/post/edit/{{$post->id}}" class="btn btn-primary">Edit</a> 
            @endif
            <img src="/storage/file/{{$subject->image}}" height="35" width="35" alt="{{$subject->cover_image}}">
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
                            <div class="col-md-10">
                                <b>{{$comment->user_name}}</b>
                            </div>
                            <div class="col-md-2">
                                @if (Auth::user()->id == $comment->user_id)
                                    <a href="/comment/delete/{{$comment->id}}" class="text-danger">delete this comment</a>
                                @endif
                            </div>
                        </div>
                        <br>
                        {{$comment->content}}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
