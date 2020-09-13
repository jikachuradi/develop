<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
  public function notice(Request $request)
  {
      //ユーザーAuthで取得
      $user_id = Auth::id();
      logger($user_id)
      //リスト全て取得
      $list = Register::all();
      //誕生日取り出し   
      $birthday = Register::where($request->birthday)->get();
　　　//記念日取り出し
　　　$anniversary = Register::where($request->anniversary)->get();
　　　//名前取り出し      
      $name =  Register::where($request->name)->get();
      //本日であれば表示させる(if) 
      if($today = date("Y-m-d")){
        $posts = Register::where('birthday', $today)->get();
      } else {
        $posts = Register::where('anniversary', $today)->get();
      }

      return redirect('admin/welcome/' , ['today' => $today,'birthday' => $birthday,'anniversary' => $anniversary,'name' => $name]);
  }  
}
