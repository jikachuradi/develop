@extends('layouts.admin')
@section('title', 'リスト一覧')

@section('content')
     <div class="container">
         <div class="row">
             <h2>リスト一覧</h2>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <a href="{{ action('Admin\RegisterController@add') }}" role="button" class="btn btn-secondary">新規登録</a>
             </div>
             <div class="col-md-8">
                 <form action="{{ action('Admin\RegisterController@index') }}"method="get">
                     <div class="form-group row">
                         <label class="col-md-2">名前</label>
                         <div class="col-md-8">
                             <input type="text" class="form-control" name="cond_name" value={{ $cond_name}}>
                         </div>
                         <div class="col-md-2">
                             {{ csrf_field() }}
                             <input type="submit" class="btn btn-secondary" value="検索">
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         <div class="row">
             <div class="admin-register col-md-12 mx-auto">
                 <div class="row">
                 <table class="table">
                     <thead>
                         <tr>
                             <th width="20%">写真</th>
                             <th width="15%">名前</th>
                             <th width="12%">誕生日</th>
                             <th width="12%">記念日</th>
                             <th width="11%">グループ</th>
                             <th width="20%">メモ</th>
                             <th width="10%">編集／削除</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($posts as $register)
                         <tr>
                             <td>
                             <img src="{{ asset('storage/image/' . $register->image_path) }}">
                             </td>
                              <td>{{ str_limit($register->name, 20)}}</td>
                             <th>{{ $register->birthday }}</th>
                             <th>{{ $register->anniversary }}</th>
                             <th>{{ $register->group }}</th>
                             <td>{{ str_limit($register->memo, 20)}}</td>
                            <td>
                                 <div>
                                    <a href="{{ action('Admin\RegisterController@edit', ['id' => $register->id]) }}">編集</a>
                                 </div>
                                 <div>
                                    <a href="{{ action('Admin\RegisterController@delete', ['id' => $register->id]) }}">削除</a>
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