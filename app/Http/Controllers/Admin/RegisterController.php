<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    
  public function add()
  {
      return view('admin.register.create');
  }
  
  public function create()
  {
      return redirect('admin/register/create');
  }

  public function edit()
  {
      return view('admin.register.edit');
  }

  public function update()
  {
      return redirect('admin/register/edit');
  }
  
}