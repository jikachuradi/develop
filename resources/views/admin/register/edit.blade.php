@extends('layouts.admin')

@section('title', 'リストの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>リスト編集</h2>
                                <form action="{{ action('Admin\RegisterController@update') }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="name" value="{{$register_form->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="birthday">誕生日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="birthday" value="{{$register_form->birthday }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">記念日</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="anniversary" value="{{$register_form->anniversary }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="group">グループ</label>
                    <div class="col-md-10">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="group"  value="家族">
                  <label class="form-check-label">パートナー</label>
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
                            <textarea class="form-control" name="memo" rows="20">{{$register_form->memo }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $register_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                     <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $register_form->id }}">                        {{ csrf_field() }}
                   <input type="submit" class="btn btn-secondary" value="更新">
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
@endsection