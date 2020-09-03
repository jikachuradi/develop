@extends('layouts.card')

@section('title', 'カード一覧')

@section('content')
     <div class="container">
         <div class="row">
             <h2>カード一覧</h2>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <input type="hidden" role="button" class="btn btn-secondary">テンプレート登録</a>
             </div>
             <div class="col-md-8">

                     <div class="form-group row">
                         <label class="col-md-2"></label>
                         <div class="col-md-8">
                             <input type="hidden" class="form-control">
                         </div>
                         <div class="col-md-2">
                             {{ csrf_field() }}
                             <input type="hidden" class="btn btn-secondary" value="検索">
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         
         <div class="row">
             <div class="admin-template col-md-12 mx-auto">
                 <div class="row">
                 <table class="table">
                     <thead>
                         <tr>
                             <th width="5%"></th>
                             <th width="75%">メッセージカード </th>
                             <th width="20%">カード削除</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($place as $files)
                         <tr>
                             <th>{{ $card->id }}</th>
                             <td>
                             <img src="{{ asset('storage/image/' . $user_id . '/' .$template_form['filename'])}}">
                             </td>
                            <td>
                                <div>
                                    <a href="{{ action('Admin\CardController@delete', ['id' => $card->id]) }}">カード削除</a>
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