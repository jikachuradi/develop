<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Register;

class RegisterController extends Controller
{
  
  public function add()
  {
      return view('admin.register.create');
  }
  
  public function create(Request $request)
  {
    
    $this->validate($request, Register::$rules);
      $register= new Register;
      $form = $request->all();
      unset($form['_token']);
      $register->fill($form);
      $register->save();
      return redirect('admin/register/create');
  }

public function index(Request $request)
{
    $cond_name = $request -> cond_name;
    if ($cond_name != ''){
        //検索されたら検索結果を取得する
        $posts = Register::where('name', $cond_name)->get();
        } else {
            //それ以外はすべてのニュースを取得する
            $posts = Register::all();
        }
        return view('admin.register.index', ['posts' => $posts, 'cond_name' => $cond_name]);
}

  public function edit(Request $request)
  {
      // Register Modelからデータを取得する
      $register = Register::find($request->id);
      if (empty($register)) {
        abort(404);    
      }
      return view('admin.register.edit', ['register_form' => $register]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Register::$rules);
      // Register Modelからデータを取得する
      $register = Register::find($request->id);
      // 送信されてきたフォームデータを格納する
      $register_form = $request->all();
      unset($register_form['_token']);
      // 該当するデータを上書きして保存する
      $register->fill($register_form)->save();
      return redirect('admin/register/');
  }

  public function delete(Request $request)
  {
      // 該当するRegister Modelを取得
      $register = Register::find($request->id);
      // 削除する
      $register->delete();
      return redirect('admin/register/');
  }  
}