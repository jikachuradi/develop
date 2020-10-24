@extends('layouts.card')

@section('title', 'メッセージカード一覧')

@section('content')
     <div class="container">
         <div class="row">
            <h2>メッセージカード一覧</h2>
         </div>
         <div class="row">
             <div class="col-md-4">
                <a href="{{ action('Admin\TemplateController@index') }}" role="button" class="btn btn-primary">メッセージカード 作成</a>
             </div>
             <div class="col-md-8">
                <div class="form-group row">
                    <label class="col-md-2"></label>
                        <div class="col-md-8">
                            <input type="hidden" class="form-control">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                        </div>
                </div>
             </div>
         </div>
         <div class="row">
             <div class="admin-template col-md-12 mx-auto">
                 <div class="row">
                 <table class="table">
                    <thead>
                        <tr>
                        <th width="80%">メッセージカード </th>
                        <th width="20%">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cards as $card)
                        <tr>
                        <td><img src="{{ Storage::disk('s3')->url($card) }}" class="img"></td>
                        <td>
                        <div>
                            <a href="{{ action('Admin\CardController@delete',['card' => $card])}}">削除</a>
                        </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>
                 </div>
             </div>
         </div>
     </div>
@endsection