<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;

use App\Template;

use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
  
  public function add()
  {
      return view('admin.card.create');
  }
  
  public function create(Request $request)
  {
    
    $this->validate($request, Card::$rules);
      $card= new Card;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$card->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $card->image_path = basename($path);
      } else {
          $card->image_path = null;
      }      
      
      unset($form['_token']);
      unset($form['image']);
      
      $card->fill($form);
      $card->save();
      return redirect('admin/card/');
  }

public function index(Request $request)
{
      $user_id = Auth::id();
      $place = 'storage/image/' . $user_id . '/';
      $files = \File::allFiles($place);
      
    $card = new Card;
      return view('admin.card.index',['filename'=> $card]);
}

  public function edit(Request $request)
  {
      // Card Modelからデータを取得する
      $card = Card::find($request->id);
      if (empty($card)) {
        abort(404);    
      }
      return view('admin.card.edit', ['card_form' => $card]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Card::$rules);
      // Card Modelからデータを取得する
      $card = Card::find($request->id);
      // 送信されてきたフォームデータを格納する
      $card_form = $request->all();
      if (isset($card_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $card->image_path = basename($path);
        unset($card_form['image']);
      } elseif (isset($rcard->remove)) {
        $card->image_path = null;
        unset($card_form['remove']);
      }      
      unset($card_form['_token']);
      // 該当するデータを上書きして保存する
      $card->fill($card_form)->save();
      return redirect('admin/card/');
  }

  public function delete(Request $request)
  {
      // 該当するCard Modelを取得
      $card = Card::find($request->id);
      // 削除する
      $card->delete();
      return redirect('admin/card/');
  }  
}