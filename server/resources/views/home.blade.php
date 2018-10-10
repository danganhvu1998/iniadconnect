@extends('layouts.app')

@section('content')
    <br><br><br><br><br>
    <p class="text-center">ヽ┏(＾0＾)┛ -- (❀‿❀) -- (ﾟｰﾟ*ヽ)ヽ(*ﾟｰﾟ*)ﾉ(ﾉ*ﾟｰﾟ)ﾉ -- (❀‿❀) -- ┗(＾0＾) ┓</p>
    <br>
    <h3 class="text-center">
            ヾ(＠＾▽＾＠)ﾉ ... 
         The world is comming soon here! Wait for it! 
            ... ヾ(＠＾▽＾＠)ﾉ
    </h3>
    <br>
    <p class="text-center">ヽ┏(＾0＾)┛ -- (❀‿❀) -- (ﾟｰﾟ*ヽ)ヽ(*ﾟｰﾟ*)ﾉ(ﾉ*ﾟｰﾟ)ﾉ -- (❀‿❀) -- ┗(＾0＾) ┓</p>
    <br><br><br><br><br>


    <div class="text-center">
        <iframe src="https://docs.google.com/presentation/d/e/2PACX-1vRzkcZVjM0RAqTazrf6JYbP1r5sJXY9pnfM7A695Nl4ZQDgGllAGWuRVR9wrv2LYLYOIoh8QxduJss9/embed?start=false&loop=false&delayms=3000" frameborder="0" width="960" height="569" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
    </div>
    <br><br><br><br><br><br>    
    <h1 class="text-center">Our Super Amazing Team</h1>
    <br><br>
    <div class="row">
        @foreach ($teamMembers as $member)
            <div class="col-md-4 text-center">
                <img src="/storage/file/{{$member->image}}" alt="" class="rounded-circle" style="height: 75%; width: 75%; object-fit: contain"><br><br>
                <a href="/user/view/{{$member->id}}">
                    <b>{{$member->name}}</b>
                </a><br>
                <p class="text-muted"></p>
            </div>
        @endforeach
    </div>
@endsection
