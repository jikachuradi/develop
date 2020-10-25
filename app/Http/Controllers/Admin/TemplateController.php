<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Template;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

use Storage;

class TemplateController extends Controller{
  
  public function add()
  {
      return view('admin.template.create');
  }
  
  public function create(Request $request)
  {
    // Varidationを行う
    $this->validate($request, Template::$rules);
      $template= new Template;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$template->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $template->image_path = Storage::disk('s3')->url($path);
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
      $templates_infos = []; //空の配列
      
      $info['name'] = 'template1';
      $info['url'] = Storage::disk('s3')->url('templates/1.jpg');
      array_push($templates_infos,$info);
      
      $info['name'] = 'template2';
      $info['url'] = Storage::disk('s3')->url('templates/2.jpg');
      array_push($templates_infos,$info);

      $info['name'] = 'template3';
      $info['url'] = Storage::disk('s3')->url('templates/3.jpg');
      array_push($templates_infos,$info);
      
      $info['name'] = 'template4';
      $info['url'] = Storage::disk('s3')->url('templates/4.jpg');
      array_push($templates_infos,$info);
      
      $info['name'] = 'template5';
      $info['url'] = Storage::disk('s3')->url('templates/5.jpg');
      array_push($templates_infos,$info);
      
      $info['name'] = 'template_spring';
      $info['url'] = Storage::disk('s3')->url('templates/spring.jpg');
      array_push($templates_infos,$info);

      $info['name'] = 'template_summer';
      $info['url'] = Storage::disk('s3')->url('templates/summer.jpg');
      array_push($templates_infos,$info);
      
      $info['name'] = 'template_autumn';
      $info['url'] = Storage::disk('s3')->url('templates/autumn.jpg');
      array_push($templates_infos,$info);

      $info['name'] = 'template_winter';
      $info['url'] = Storage::disk('s3')->url('templates/winter.jpg');
      array_push($templates_infos,$info);

      //logger('★★★★★★★');
      //logger($templates_infos);

     return view('admin.template.index', ['templates_infos' => $templates_infos]);
  }

  public function edit(Request $request)
  {
      // 画像（テンプレート）データを取得する
      $img = $_GET['num'];
      if ($img=='template1') {
        $image='templates/1.jpg';
      }elseif ($img=='template2') {
        $image='templates/2.jpg';
      }elseif ($img=='template3') {
        $image='templates/3.jpg';
      }elseif ($img=='template4') {
        $image='templates/4.jpg';
      }elseif ($img=='template5') {
        $image='templates/5.jpg';
      }elseif ($img=='template_spring') {
        $image='templates/spring.jpg';
      }elseif ($img=='template_summer') {
        $image='templates/summer.jpg';
      }elseif ($img=='template_autumn') {
        $image='templates/autumn.jpg';  
      }elseif ($img=='template_winter') {
        $image='templates/winter.jpg';  
      }
      
      $template = new Template;
      $path = $image;
      $template -> image_path = Storage::disk('s3')->url($path);

      return view('admin.template.edit', ['template_form' => $template,'img' => $img]);
  }
  
  public function card_create(Request $request)
  {
    $template_form = $request->all();

      $img = $template_form['filename'];
      if ($img=='template1') {
        $image='templates/1.jpg';
      }elseif ($img=='template2') {
        $image='templates/2.jpg';
      }elseif ($img=='template3') {
        $image='templates/3.jpg';
      }elseif ($img=='template4') {
        $image='templates/4.jpg';
      }elseif ($img=='template5') {
        $image='templates/5.jpg';
      }elseif ($img=='template_spring') {
        $image='templates/spring.jpg';
      }elseif ($img=='template_summer') {
        $image='templates/summer.jpg';
      }elseif ($img=='template_autumn') {
        $image='templates/autumn.jpg';  
      }elseif ($img=='template_winter') {
        $image='templates/winter.jpg';  
      }

    $path = $image;
    //画像を取得し、指定の大きさに切り取る
    $card_img = Image::make(Storage::disk('s3')->url($path))->crop(769, 562);
    
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

    $user_id = Auth::id();
    $filename = uniqid();
    //$card_img->save(storage_path('app/public/image/'. $user_id . '/' . $filename.$template_form['filename']));

    // バケットの`users_message_cards`フォルダへアップロード
    $card_path = Storage::disk('s3')->put('users_message_cards/'. $user_id . '/' . $filename.$template_form['filename'], $card_img->stream(),'public');

    // アップロードした画像のフルパスを取得
    //$path->image_path = Storage::disk('s3')->url($card_path);

    return redirect('admin/card');
  }
    
  public function mb_wordwrap($str, $width=20, $break=PHP_EOL)
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