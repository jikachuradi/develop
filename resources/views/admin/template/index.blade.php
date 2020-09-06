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
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/1.jpg')}}">
                            </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template1">
                                </form>
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/2.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template2">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/3.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template3">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/4.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template4">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/5.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template5">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/spring.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template_spring">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/summer.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template_summer">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/autumn.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template_autumn">
                                </form>	
                            </td>
                         </tr>
                         <tr>
                            <td>
                                <img src="{{ asset('storage/image/template/winter.jpg')}}">
                             </td>
                            <td>
                                <form action="{{ action('Admin\TemplateController@edit')}}"  method="get">   
                                <input type="submit" class="btn btn-secondary" name="num" value="template_winter">
                                </form>
                            </td>
                         </tr>
                         </tbody>
                 </table>
             </div>
        </div>
     </div>
</div>
@endsection