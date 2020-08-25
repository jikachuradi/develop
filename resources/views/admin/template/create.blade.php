{{-- layouts/template.blade.phpを読み込む --}}
@extends('layouts.template')


{{-- template.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'テンプレート登録')

{{-- template.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>テンプレート登録</h2>
                <form action="{{ action('Admin\TemplateController@create')}}"
                method="post" enctype="multipart/form-data">
                    
                @if (count($errors) > 0)
                   <ul>
                       @foreach($errors->all() as $e)
                              <li>{{ $e }}</li>
                       @endforeach
                   </ul>
                @endif
                    <div class="form-group row">
                        <label class="col-md-2">テンプレート</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
               　　<div class="form-group row">
                    <label class="col-md-2" for="messes">メッセージ</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="messes" value="{{ old('text') }}">
                    </div>
                　　</div>                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-secondary" value="保存">
                </form>
            </div>
        </div>
    </div>
@endsection