<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Register;//RegisterModel使用

use Illuminate\Support\Facades\Auth;//ユーザーAuthで取得

use Storage;

class WelcomeController extends Controller
{
  public function notice(Request $request)//通知
  {
      //本日の日付取得
      $today = date("m-d");//年月日ではなく月日での一致とする

      $namesArray = []; //空の配列
      $anniversaryArray = []; //空の配列

      if($user = Auth::user()){ //ログインしていたら誕生日・記念日を通知
        $listDatas = Register::where('user_id',Auth::user()->id)->get();
          foreach($listDatas as $data){//リスト全てをforeachで配列する
            $birthday = substr($data['birthday'], 5);//「substr」「5」2020-09-22の年（2020-）を除き、月日以降（09-22）
            $anniversary = substr($data['anniversary'], 5);
            if($birthday == $today){ //本日と一致したら
              array_push($namesArray,$data['name']);//array_push — 一つ以上の要素を配列の最後に追加する
            }if($anniversary == $today){
              array_push($anniversaryArray,$data['name']);
            }
          }
      } else { //ログインしていなければ非表示
        $listDatas = null ;
      }
      
      $main_image = Storage::disk('s3')->url('subjects/'.'main.jpg');
      
    return view('/welcome',['today' => $today,'name' => $namesArray,'anniversaryName' =>$anniversaryArray,'main_image' => $main_image]);
  }
}