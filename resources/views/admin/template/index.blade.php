@extends('layouts.template')

@section('title', 'テンプレート選択')

@section('content')
     <div class="container">
         <div class="row">
             <h2>テンプレート選択</h2>
         </div>
         <div class="row">
             <div class="col-md-4">
             </div>
             <div class="col-md-8">
                     <div class="form-group row">
                         <label class="col-md-2"></label>
                         <div class="col-md-8">
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
                             <th width="80%">テンプレート</th>
                             <th width="20%">メッセージカード作成</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($templates_infos as $info)
                         <tr>
                            <td>
                                <img src="{{ $info['url'] }}" class="img">
                            </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-primary" name="num" value="{{ $info['name'] }}">
                                </form>
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