<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{   
    protected $guarded = array('id');

    //Validation(Modelでデータを保存する前に、フォームからデータを送信されてきた値が正しいかどうか確認)
    public static $rules = array(
        'name' => 'required',
        'birthday' => 'required',
        'anniversary' => 'required',
        'group' => 'required',
    );
    
}
