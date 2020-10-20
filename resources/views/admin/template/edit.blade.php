@extends('layouts.template')

@section('title', 'メッセージカード作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>メッセージカード作成</h2>
                    <form action="{{ action('Admin\TemplateController@card_create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="image">テンプレート</label>
                        <div class="col-md-10">
                            <input type="hidden" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                選択中: {{ $template_form->image_path }}
                                <input type="hidden" name="filename" value="{{ $template_form->image_path }}">
                            </div>
                            <img src="{{ asset('storage/image/template/' . $template_form->image_path) }}" class="img">
                            <div class="form-check"></div>
                        </div>
                    </div>
                　　<div class="form-group row">
                        <label class="col-md-2" for="message">メッセージ</label>
                        <div class="col-md-10">
<!--文字位置がずれてしまうため左寄せで入力-->
<textarea name="message" class="form-control-message" cols='50' rows="5" maxlength="100">
○○へ
お誕生日おめでとう！
素敵な１年になりますように★
</textarea>
                        </div>
                　　</div>
                    <div class="form-group row">
                        <div class="col-md-10">
                        {{ csrf_field() }}
                       <input type="submit" class="btn btn-primary" value="作成">
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
@endsection