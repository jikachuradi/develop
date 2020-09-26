<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Register;//RegisterModel使用

use Illuminate\Support\Facades\Auth;//ユーザーAuthで取得

class WelcomeController extends Controller
{
  public function notice(Request $request)
  {
      //ユーザーAuthで取得
      $user_id = Auth::id();
      //リスト全て取得
      $listDatas = Register::get();
      //本日の日付取得
      $today = date("m-d");//年月日ではなく月日での一致

      $namesArray = []; //空の配列
      $anniversaryArray = []; //空の配列

      foreach($listDatas as $data){//リスト全てをforeachで配列する
        $birthday = substr($data['birthday'], 5);//「substr」「5」2020-09-22の年（2020）を除き、月日以降（09-22）
          if($birthday == $today){
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