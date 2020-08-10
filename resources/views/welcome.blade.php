<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         {{-- 画面幅を小さくしたときに文字や画像の大きさを調整 --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>List of Celebrations</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込み --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込み --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- card.scssを読み込み --}}
        <link href="{{ secure_asset('css/card.css') }}" rel="stylesheet">
        
            <style>
            .content {
                margin-top: 150px;
                text-align: center;
            }

            .title {
                color: #636b6f;
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 150px;
            }
            
            .footer{
                margin-top: 200px;
            }
            
            </style>
    </head>
    
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバー--}}
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('List of Celebrations') }}
                    </a>                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ __('’s MENU')}} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/')}}">TOP</a>
                                    <a class="dropdown-item" href="{{url('/admin/register/create')}}">リスト保存</a>
                                    <a class="dropdown-item" href="#">リスト一覧</a>
                                    <a class="dropdown-item" href="{{url('/admin/card/create')}}">カード作成</a>
                                    <a class="dropdown-item" href="#">カード一覧</a>
                                    <a class="dropdown-item" href="#">設定</a>
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
                <div class="title m-b-md">
                List of Celebrations    
                </div>

                <div class="links">
                    <a href="#">リスト保存</a>
                    <a href="#">リスト一覧</a>
                    <a href="#">カード作成</a>
                    <a href="#">カード一覧</a>
                    <a href="#">設定</a>
                </div>
                
                @endguest
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
    <footer class="footer">©️2020  List of Celebrations </footer>
</html>