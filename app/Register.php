<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{   
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'birthday' => 'required',
        'anniversary' => 'required',
        'group' => 'required',
        'memo' => 'required',
    );
    
}
