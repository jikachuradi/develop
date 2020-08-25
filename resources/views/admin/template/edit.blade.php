@extends('layouts.template')

@section('title', 'カード作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード作成</h2>
                    <form action="{{ action('Admin\TemplateController@card_create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                選択中: {{ $template_form->image_path }}
                        <input class="form-control" name="filename" value="{{ $template_form->image_path }}">
                            </div>
                            <img src="{{ asset('storage/image/' . $template_form->image_path) }}">
                            <div class="form-check">
                            </div>
                        </div>
                    </div>
                　　<div class="form-group row">
                    <label class="col-md-2" for="messes">メッセージ</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="messes" value="{{ old('text') }}">
                    </div>
                　　</div>
                    <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $template_form->id }}">
                    {{ csrf_field() }}
                   <input type="submit" class="btn btn-secondary" value="作成">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection