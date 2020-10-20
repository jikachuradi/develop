{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'リスト登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>リスト登録</h2>
                <form action="{{ action('Admin\RegisterController@create')}}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                   <ul>
                       @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                       @endforeach
                   </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2" for="name">名前</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">誕生日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="birthday">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">記念日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="anniversary">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="group">グループ</label>
                    <div class="col-md-10">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="group"  value="パートナー">
                          <label class="form-check-label" >パートナー</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="group"  value="家族">
                          <label class="form-check-label">家族</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="group"  value="友人">
                          <label class="form-check-label">友人</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="group"  value="職場">
                          <label class="form-check-label">職場</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="group"  value="その他">
                          <label class="form-check-label">その他</label>
                        </div>
                    </div>  
                </div>
                <div class="form-group row">
                    <label class="col-md-2">メモ</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="memo" rows="20">{{ old('memo') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="保存">
                </form>
            </div>
        </div>
    </div>
@endsection