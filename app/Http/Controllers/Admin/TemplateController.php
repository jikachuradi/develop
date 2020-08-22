<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Template;

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
            //それ以外はすべてのニュースを取得する
            $posts = Template::all();
        }
        return view('admin.template.index', ['posts' => $posts, 'cond_name' => $cond_name]);
}

  public function edit(Request $request)
  {
      // Template Modelからデータを取得する
      $template = Template::find($request->id);
      if (empty($template)) {
        abort(404);    
      }
      return view('admin.template.edit', ['template_form' => $template]);
  }


  public function update(Request $request)
  {
    logger("test");
      // Validationをかける
      $this->validate($request, Template::$rules);
      // template Modelからデータを取得する
      $template = Template::find($request->id);
      // 送信されてきたフォームデータを格納する
      $template_form = $request->all();
      if (isset($template_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $template->image_path = basename($path);
        unset($template_form['image']);
      } elseif (isset($template->remove)) {
        $template->image_path = null;
        unset($template_form['remove']);
      }      
      unset($template_form['_token']);
      // 該当するデータを上書きして保存する
      $template->fill($template_form)->save();
      return redirect('admin/template/');
  }
  
        public function card_create(Request $request){
        logger("★★★★★★★★★★");
        logger($request);
        //画像を取得し、指定の大きさに切り取る
        $template_form = $request->all();
        $path = $template_form->image_path;
        $card_img = Image::make($path)->crop(568, 440); //①

        //タイトルを画像に表示させる
        //表示させる文字、表示場所をx/yで指定する
        $card_img ->text('text', 284, 100, function($font) {
            $font->file('fonts/SawarabiGothic-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->color('#ffffff');
        }); //②

        //長めの文章を指定文字数で分割する
        $max_len = 26;
        $lines = self::mb_wordwrap($description, $max_len);

        //ディスクリプションを画像に表示させる
        $card_img ->text($lines, 284, 280, function($font) {
            $font->file('fonts/SawarabiGothic-Regular.ttf');
            $font->size(18);
            $font->align('center');
            $font->color('#ffffff');
        }); //②

        //storageに保存する(適宜書き換えてください)
        $card_img->save(public_path('images/test.png'));
    }
    
    public function mb_wordwrap($str, $width, $break=PHP_EOL )
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