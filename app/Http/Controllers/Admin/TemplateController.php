<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Template;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class TemplateController extends Controller{
  
  public function add()
  {
      return view('admin.template.create');
  }
  
  public function create(Request $request)
  {
    
    $this->validate($request, Template::$rules);
      $template= new Template;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$template->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $template->image_path = basename($path);
      } else {
          $template->image_path = null;
      }      
      
      unset($form['_token']);
      unset($form['image']);
      
      $template->fill($form);
      $template->save();
      return redirect('admin/template/');
  }

public function index(Request $request)
{
    $cond_name = $request -> cond_name;
    if ($cond_name != ''){
        //検索されたら検索結果を取得する
        $posts = Template::where('name', $cond_name)->get();
        } else {
            //それ以外はすべてを取得する
            $posts = Template::all();
        }
        return view('admin.template.index', ['posts' => $posts, 'cond_name' => $cond_name]);
}

  public function edit(Request $request)
  {
      // データを取得する
      $img = $_GET['num'];
      if ($img=='template1') {
        $image='storage/image/template/1.jpg';
      }elseif ($img=='template2') {
        $image='storage/image/template/2.jpg';
      }elseif ($img=='template3') {
        $image='storage/image/template/3.jpg';
      }elseif ($img=='template4') {
        $image='storage/image/template/4.jpg';
      }elseif ($img=='template5') {
        $image='storage/image/template/5.jpg';
      }elseif ($img=='template6') {
        $image='storage/image/template/6.jpg';
      }elseif ($img=='template_spring') {
        $image='storage/image/template/spring.jpg';
      }elseif ($img=='template_summer') {
        $image='storage/image/template/summer.jpg';
      }elseif ($img=='template_autumn') {
        $image='storage/image/template/autumn.jpg';  
      }elseif ($img=='template_winter') {
        $image='storage/image/template/winter.jpg';  
      }
      
      $template = new Template;
      $path = $image;
      $template->image_path = basename($path);
      
      return view('admin.template.edit', ['template_form' => $template]);
      }
  
        public function card_create(Request $request){
        logger("★★★★★★★★★★");
        logger($request);
        //画像を取得し、指定の大きさに切り取る
        $template_form = $request->all();
        $card_img = Image::make(storage_path('app/public/image/template/'. $template_form['filename']))->crop(769, 562);
        
        //タイトル入力しないので不要（名前入力で使用するかも）
        //タイトルを画像に表示させる.表示させる文字、表示場所をx/yで指定する
       /* 
       $card_img->text($template_form['messes'], 400, 300, function($font) {
            $font->file(storage_path('app/fonts/GenShinGothic-Heavy.ttf'));
            $font->size(20);
            $font->align('center');
            $font->color('#ff0000');
        }); 
        */

        //長めの文章を指定文字数で分割する
        $max_len = 100; //少なく設定すると変な箇所で改行されてしまうので要検討
        $lines = self::mb_wordwrap($template_form['message'], $max_len);

        //テキストを画像に表示させる
        $card_img->text($lines, 390, 325, function($font) {
            $font->file(storage_path('app/fonts/GenShinGothic-Heavy.ttf'));
            $font->size(20);
            $font->align('center');
            $font->color('#000000');
        });

        //storageに保存する
        //$card_img->save(public_path('image/test14.png'));　保存先を指定する場合
        $user_id = Auth::id();
        $filename = uniqid();
        $card_img->save(storage_path('app/public/image/'. $user_id . '/' . $filename.$template_form['filename']));
        return redirect('admin/card');
        }
    
    public function mb_wordwrap($str, $width=20, $break=PHP_EOL )
    {
        $c = mb_strlen($str);
        $arr = [];
        for ($i=0; $i<=$c; $i+=$width) {
            $arr[] = mb_substr($str, $i, $width);
        }
        return implode($break, $arr);
    }

  public function delete(Request $request)
  {
      // 該当するTemplate Modelを取得
      $template = Template::find($request->id);
      // 削除する
      $template->delete();
      return redirect('admin/template/');
  }  
}