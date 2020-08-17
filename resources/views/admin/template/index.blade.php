@extends('layouts.template')

@section('title', 'テンプレート一覧')

@section('content')
     <div class="container">
         <div class="row">
             <h2>テンプレート一覧</h2>
         </div>
         <div class="row">
             <div class="col-md-4">
                 <a href="{{ action('Admin\TemplateController@add') }}" role="button" class="btn btn-secondary">新規作成</a>
             </div>
             <div class="col-md-8">
                 <form action="{{ action('Admin\TemplateController@index') }}"method="get">
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
             <div class="admin-template col-md-12 mx-auto">
                 <div class="row">
                 <table class="table">
                     <thead>
                         <tr>
                             <th width="5%"></th>
                             <th width="85%">テンプレート</th>
                             <th width="10%">編集／削除</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($posts as $template)
                         <tr>
                             <th>{{ $template->id }}</th>
                             <td>
                             <img src="{{ asset('storage/image/' . $template->image_path) }}">
                             </td>
                            <td>
                                 <div>
                                    <a href="{{ action('Admin\TemplateController@edit', ['id' => $template->id]) }}">編集</a>
                                 </div> 
                                 <div>
                                    <a href="{{ action('Admin\TemplateController@delete', ['id' => $template->id]) }}">削除</a>
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