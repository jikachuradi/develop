@extends('layouts.card')

@section('title', 'カード登録')

{{-- card.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード作成画面</h2>
            </div>
        </div>
    </div>
    
    <input type="submit" class="btn btn-secondary" value="作成">

@endsection

<?php

    function card_create($title,$description){
        //publicディレクトリにある元画像を取得し、指定の大きさに切り取る
        $card_img = Image::make(public_path('image/tF5g1xRRbhWoSLGlKhtaSG9DmapvW2cKj2wPBCeM.gif'))->crop(568, 440); //①

        //タイトルを画像に表示させる
        //表示させる文字、表示場所をx/yで指定する
        $card_img ->text($title, 284, 100, function($font) {
            $font->file('fonts/SawarabiGothic-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->color('#ffffff');
        }); //②

        //長めの文章を指定文字数で分割する
        $max_len = 26;

        //ディスクリプションを画像に表示させる
        $card_img ->text($lines, 284, 280, function($font) {
            $font->file('fonts/SawarabiGothic-Regular.ttf');
            $font->size(18);
            $font->align('center');
            $font->color('#ffffff');
        }); //②

        //storageに保存する(適宜書き換えてください)
        $card_img->save(public_path('images/test.png')); //③
    }
?>