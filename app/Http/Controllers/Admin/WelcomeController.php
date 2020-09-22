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
      //リスト全て取得
      $list = Register::all();
      logger($list);
      //誕生日取り出し
      $birthday = Register::select('birthday')->get();
      logger($birthday);
      //記念日取り出し
      $anniversary = Register::select('anniversary')->get();
      logger($anniversary); 

      $today = date("Y-m-d");//年月日ではなく月日での検索可能か（もしくはリスト入力内容を変えてしまう）
      
      //誕生日が本日であれば表示させる(if) 
      if(strtotime($birthday) == strtotime($today)){
      //名前取り出し
      $name = Register::select('name')->get();
      logger($name); 
      /*}else if(strtotime($anniversary) === strtotime($today)){*/
      } else {
      }
      return view('/welcome',['today' => $today,'name' => $name]);
  }
}