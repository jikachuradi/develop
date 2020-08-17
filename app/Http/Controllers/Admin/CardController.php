<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;

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
    $cond_name = $request -> cond_name;
    if ($cond_name != ''){
        //検索されたら検索結果を取得する
        $posts = Card::where('name', $cond_name)->get();
        } else {
            //それ以外はすべてのニュースを取得する
            $posts = Card::all();
        }
        return view('admin.card.index', ['posts' => $posts, 'cond_name' => $cond_name]);
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