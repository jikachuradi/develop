<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Register;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  
  public function add()
  {
      return view('admin.register.create');
  }
  
  public function create(Request $request)
  {
    // Varidationを行う
    $this->validate($request, Register::$rules);
    $register= new Register;
    $form = $request->all();
    $user_id = Auth::user()->id;
    $form['user_id'] = $user_id;
    //logger(Auth::user());
    
      // フォームから画像が送信されてきたら、保存して、$register->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $register->image_path = basename($path);
      } else {
          $register->image_path = null;
      }      
      
      unset($form['_token']);
      unset($form['image']);
      
      $register->fill($form);
      $register->save();
      logger($register);
      return redirect('admin/register/');
  }

public function index(Request $request)
{
    $user = Auth::user();
    
    $cond_name = $request -> cond_name;
    if ($cond_name != ''){
        //検索されたら検索結果を取得する
        //「where」条件付、「like」似ている、「％」なんでも良い(曖昧検索)、「"{}"」エスケープ（文字列ではなく変数入れるため）
        $posts = Register::where('user_id',Auth::user()->id)->where('name', 'like', "%{$cond_name}%")->get(); 
        } else {
        //それ以外はすべて取得する
        $posts = Register::where('user_id',Auth::user()->id)->get();
        }
        return view('admin.register.index', ['user'=>$user, 'posts' => $posts, 'cond_name' => $cond_name]);
}

  public function edit(Request $request)
  {
      // Register Modelからデータを取得する
      $register = Register::find($request->id);
      if(Auth::user()->id!=$register->user_id){
        abort(403);//認証失敗
      }
      if (empty($register)) {
        abort(404);    
      }
      //logger($register);
    
      return view('admin.register.edit', ['register_form' => $register]);
  }


  public function update(Request $request)
  {
    logger("test");
      // Validationをかける
      $this->validate($request, Register::$rules);
      // Register Modelからデータを取得する
      $register = Register::find($request->id);
      // 送信されてきたフォームデータを格納する
      $register_form = $request->all();
      if (isset($register_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $register->image_path = basename($path);
        unset($register_form['image']);
      } elseif (isset($request->remove)) {
        $register->image_path = null;
        unset($register_form['remove']);
      }      
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