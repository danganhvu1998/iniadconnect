@extends('layouts.app')

@section('content')
    <h3>{{__('messages.informationSetting')}}</h3>
    @if (Auth::user()->type == 0)
        <b class="text-primary"> {{__('messages.waitAdminConfirmNewUser')}} </b>
    @elseif (Auth::user()->type == -1)
        <b class="text-danger"> {{__('messages.adminRejectedNewUser')}} </b>
    @elseif (Auth::user()->type == -2)
        <b class="text-danger"> {{__('messages.adminBannedUser')}} </b>
    @endif
    <!--Change Name-->
    {!! Form::open(['action' => 'UsersController@userSettingNameChange', 'method' => 'POST']) !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">{{__('messages.fullname')}}</span>
        </div>
        {{Form::text("user_name", Auth::user()->name, ['class'=>'form-control', 'placeholder' => __('messages.fullname')])}}
        {{Form::select('language', [0 => "日本語", 1 => 'English'], Auth::user()->language)}}
        {{Form::submit(__('messages.save'), ['class' => 'btn btn-outline-primary'])}}
    </div>
    {!! Form::close() !!}

    <!--Change Password--> <hr>
    {!! Form::open(['action' => 'UsersController@userSettingPasswordChange', 'method' => 'POST']) !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">{{__('messages.userCurrentPassword')}}</span>
        </div>
        {{Form::password("user_old_password", ['class'=>'form-control', 'placeholder' => __('messages.userCurrentPassword')])}}
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">{{__('messages.userNewPassword')}}</span>
        </div>
        {{Form::text("user_new_password", "", ['class'=>'form-control', 'placeholder' => __('messages.userNewPassword')])}}
        {{Form::submit(__('messages.save'), ['class' => 'btn btn-outline-primary'])}}
    </div>
    
    {!! Form::close() !!}

    <!--Change Image--> <hr>
    {!! Form::open(['action' => 'UsersController@userSettingImageChange', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <b>{{__('messages.userProfilePicture')}}</b><br>
        <img src="/storage/file/{{Auth::user()->image}}" height="100" alt="{{Auth::user()->image}}">   
        {{Form::file('file')}}
    {{Form::submit('UPLOAD (Maximum 2MB)', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}

    <!--Change Card Image--> <hr>
    @if (!isset(Auth::user()->card_image))
        <p><b class="text-danger">{{__('messages.haveToProveStudentCard')}}</b></p>
    @endif
    {!! Form::open(['action' => 'UsersController@userSettingCardImageChange', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <b>{{__('messages.userCardPicture')}}</b><br>
        <img src="/storage/file/{{Auth::user()->card_image}}" height="100" alt="{{Auth::user()->card_image}}">   
        {{Form::file('file')}}
    {{Form::submit('UPLOAD (Maximum 2MB)', ['class' => 'btn btn-outline-primary'])}}
    {!! Form::close() !!}
@endsection
