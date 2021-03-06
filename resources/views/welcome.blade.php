<!DOCTYPE html>
<!--言語環境設定-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <!-- windowsの基本ブラウザであるedgeに対応するという記載 -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <!-- 画面幅を小さくしたときに文字や画像の大きさを調整 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token（CSRF攻撃への対策） -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bird - Birth × Card -</title>
        <!-- Scripts -->
        <!-- Laravel標準で用意されているJavascriptを読み込み -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <!-- Fonts（フォント）-->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <!-- Laravel標準で用意されているCSSを読み込み -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <!-- CSSを読み込み -->
        <link href="{{ secure_asset('css/welcome.css') }}" rel="stylesheet">
        <!-- font-awesome(フォントとアイコンのツールキット)を読み込み -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </head>
    
    <body class="body">
        <div id="app"><!--idはページに1つ、classはページに1つでも複数でもOK。同じcssが書かれていた場合idとclassではidが優先される-->
            <!-- ナビゲーションバー-->
            <!-- nav-expand-:レスポンシブデザイン-->
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" style="color:#636b6f;" href="{{ url('/') }}">Bird - Birth × Card -</a>
                    <!--collapse：折りたたみ。ターゲット要素は href="#..." や data-target="#..." で指定。aria-expand="..." は開閉状態、aria-controls="..." は対象を示します-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links(認証リンク) -->
                                <!-- ログインしていなかったらログイン画面へのリンクを表示 -->
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
                        <!--ログインしていなかったらどのボタンを押してもログイン画面へ-->
                        <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-user-plus"></span>リスト登録</a>
                        <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-list"></span>リスト一覧</a>
                        <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-square"></span>メッセージカード作成</a>
                        <a class="btn btn-primary" href="{{ route('login') }}" ><span class="fa fa-th-list"></span>メッセージカード一覧</a>
                    <div><img src="{{ $main_image }}"></div><!--メイン画像-->
                </div>
            </div>
        </div>
    </body>
    
    <footer class="footer">©️2020 Bird - Birth × Card </footer>
    
    <!-- ログインしていたらユーザー名とログアウトボタンを表示 -->
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
                        document.getElementById('logout-form').submit();"><!-- logout -->
                {{ __('messages.Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </li>
    </ul>
    </div>
    </div>
    </nav>
    
    <div class="content">
        <!-- タイトルとサブタイトル -->
        <div class="title m-b-md">Bird</div>
        <div class="sub-title m-b-md-2">- Birth × Card -</div>
        <!--誕生日と記念日 通知-->
        @foreach($name as $na)
        <div class="text notice">今日は{{$today}} {{$na}}さんの誕生日です！</div>
        @endforeach
        @foreach($anniversaryName as $na)
        <div class="text notice">今日は{{$today}} {{$na}}さんとの記念日です！</div>
        @endforeach
        <!--ボタン-->
        <a class="btn btn-primary" href="{{url('/admin/register/create')}}" ><span class="fa fa-user-plus"></span>リスト登録</a>
        <a class="btn btn-primary" href="{{url('/admin/register')}}" ><span class="fa fa-list"></span>リスト一覧</a>
        <a class="btn btn-primary" href="{{url('/admin/template')}}" ><span class="fa fa-square"></span>メッセージカード作成</a>
        <a class="btn btn-primary" href="{{url('/admin/card')}}" ><span class="fa fa-th-list"></span>メッセージカード一覧</a>
        <div><img src="{{ $main_image}}"></div><!--メイン画像-->
    </div>
    </div>
    @yield('content')
    </div>
    </body>
    
    <footer class="footer">©️2020 Bird - Birth × Card - </footer>
    @endguest
</html>