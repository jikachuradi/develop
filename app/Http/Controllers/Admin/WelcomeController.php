<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Register;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
  public function notice(Request $request)
  {
      //ユーザーAuthで取得
      $user_id = Auth::id();
      logger($user_id);
      //リスト全て取得
      /*$list = Register::all();*/
      //誕生日取り出し   
      $birthday = Register::find($request->birthday);
      //記念日取り出し
      $anniversary = Register::where($request->anniversary);
      //名前取り出し      
      $name =  Register::where($request->name);
      //本日であれば表示させる(if) 
      $today = date("Y/m/d");
      /*if(strtotime($today) === strtotime($birthday)){
        echo "本日は誕生日です";
      }else if(strtotime($today) === strtotime($anniversary)){
        echo "本日は記念日です";
      }else{
      }*/
      return view('/welcome',['user_id' => $user_id,'today' => $today,'birthday' => $birthday]);
  }
}