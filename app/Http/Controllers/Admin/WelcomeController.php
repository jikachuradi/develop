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
      $listDatas = Register::get();
      
      $today = date("m-d");//年月日ではなく月日での検索可能か（もしくはリスト入力内容を変えてしまう）
      logger($today);
      
      $namesArray = []; //空の配列
      $anniversaryArray = []; //空の配列
      foreach($listDatas as $data){
        $birthday = substr($data['birthday'], 5);
        logger($birthday);
        if($birthday == $today){
          logger($data['name']);
          array_push($namesArray,$data['name']);
          $anniversary = substr($data['anniversary'], 5);
        if($anniversary == $today){
          array_push($anniversaryArray,$data['name']);
      }
      }
     }

      return view('/welcome',['today' => $today,'name' => $namesArray,'anniversaryName' =>$anniversaryArray]);
  }
}