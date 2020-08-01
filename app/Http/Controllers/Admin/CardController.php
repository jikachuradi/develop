<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    
  public function add()
  {
      return view('admin.card.create');
  }
  
  public function create()
  {
      return redirect('admin/card/create');
  }

  public function edit()
  {
      return view('admin.card.edit');
  }

  public function update()
  {
      return redirect('admin/card/edit');
  }
  

}
