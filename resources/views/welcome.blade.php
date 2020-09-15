<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         {{-- 画面幅を小さくしたときに文字や画像の大きさを調整 --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bird - Birth × Card -</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込み --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込み --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- CSSを読み込み --}}
        <link href="{{ secure_asset('css/welcome.css') }}" rel="stylesheet">
        {{-- font-awesomeを読み込み --}}
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    
    <body class="body">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <div class="navbar-brand" href="{{ url('/') }}">
                    Bird - Birth × Card -
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a></li>
                        </ul>
                    </div>
                </div>
            </nav>                                
                <div class="content">
                    <div class="title m-b-md">Bird</div>
                         <div class="sub-title m-b-md-2">- Birth × Card -</div>
                                <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-user-plus"></span>リスト登録</a>
                                <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-list"></span>リスト一覧</a>
                                <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-square"></span>メッセージカード作成</a>
                                <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-th-list"></span>メッセージカード一覧</a>
                        <div><img src="{{ asset('storage/image/main.jpg')}}"></div>
                    </div>
                </div>
            <main class="py-4"></main>
        </div>
    </body>
    <footer class="footer">©️2020  List of Celebrations </footer>
    
                {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ __('’s MENU')}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/')}}">TOP</a>
                                    <a class="dropdown-item" href="{{url('/admin/register/create')}}">リスト登録</a>
                                    <a class="dropdown-item" href="{{url('/admin/register')}}">リスト一覧</a>
                                    <a class="dropdown-item" href="{{url('/admin/template')}}">メッセージカード作成</a>
                                    <a class="dropdown-item" href="{{url('/admin/card')}}">メッセージカード一覧</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                <div class="content">
                    <div class="title m-b-md">Bird</div>
                    <div class="sub-title m-b-md-2">- Birth × Card -</div>
                    
                 <form action="{{ action('Admin\WelcomeController@notice') }}" method="get">
                            <div class="text notice">今日は{{$today}} {$name->name}さん{$birthday}日です！</div>
                 </form>

                            <a class="btn btn-primary" href="{{url('/admin/register/create')}}" ><span class="fa fa-user-plus"></span>リスト登録</a>
                            <a class="btn btn-primary" href="{{url('/admin/register')}}" ><span class="fa fa-list"></span>リスト一覧</a>
                            <a class="btn btn-primary" href="{{url('/admin/template')}}" ><span class="fa fa-square"></span>メッセージカード作成</a>
                            <a class="btn btn-primary" href="{{url('/admin/card')}}" ><span class="fa fa-th-list"></span>メッセージカード一覧</a>
                        <div><img src="{{ asset('storage/image/main.jpg')}}"></div>
                    </div>
                </div>
                
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
    <footer class="footer">©️2020 Bird - Birth × Card - </footer>
    @endguest
</html>