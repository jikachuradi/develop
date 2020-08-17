@extends('layouts.template')

@section('title', 'カード作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>カード作成</h2>
                                <form action="{{ action('Admin\TemplateController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                    <div class="form-group row">
                    <label class="col-md-2" for="text">テキスト</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="text" value="{{ old('text') }}">
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                選択中: {{ $template_form->image_path }}
                            </div>
                            <img src="{{ asset('storage/image/' . $template_form->image_path) }}">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $template_form->id }}">
                    {{ csrf_field() }}
                   <input type="submit" class="btn btn-secondary" value="更新">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection