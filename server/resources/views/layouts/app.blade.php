<!DOCTYPE html>
@guest
    <html lang="ja">
@elseif(Auth::user()->language==0)
    <html lang="ja">
@else
    <html lang="en">
@endguest
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        IniTomo
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light navbar-laravel" style="background-color: #e3f2fd;">
            <div class="container"><!--container-fluid-->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/storage/icon/smallIcon.gif" alt="" width="30" height="30">
                    イニトモ
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @if (Auth::user()->type>0)
                                <li><a class="nav-link" href="/subject/view"><b>{{__("messages.subject")}}</b></a></li>
                                <li><a class="nav-link" href="/project/view"><b>{{__("messages.project")}}</b></a></li>
                            @endif
                            @if (Auth::user()->type == 3)
                                <li><a class="nav-link" href="/admin"><b>ADMIN</b></a></li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img width="30" src="/storage/file/{{Auth::user()->image}}" alt=""> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/user/setting/setting">
                                        {{ __('messages.userInfoSetting') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ __($error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ __(session()->get('message')) }}
                    </div>
                @endif
                @yield('content')
                <div class="text-center text-muted">
                    <hr>
                    Thank you for using Initomo. You can find Initomo's source code <a href="https://github.com/danganhvu1998/iniadconnect">here</a>
                </div>
                <!--
                <div id="donate" class="text-center">
                        <hr>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="95VX9JHHCMSWS">
                            <input type="hidden" name="on0" value="Buy me a cup of coffee!">Love this project? Donate me a cup of coffee!<br>
                            <select name="os0">
                                <option value="A small cup of coffee">A small cup of coffee ¥100 JPY</option>
                                <option value="Big coffee cup">Big coffee cup ¥400 JPY</option>
                                <option value="A bottle of coffee">A bottle of coffee ¥1,000 JPY</option>
                                <option value="A tank of coffee">A tank of coffee ¥10,000 JPY</option>
                                <option value="A swimming-pool full of coffee! Yay!">A swimming-pool full of coffee! Yay! ¥50,000 JPY</option>
                            </select><br><br>
                            <input type="hidden" name="currency_code" value="JPY">
                            <input type="image" src="https://www.paypalobjects.com/en_US/JP/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                </div>
                -->
            </div>
        </main>
    </div>
</body>
</html>
