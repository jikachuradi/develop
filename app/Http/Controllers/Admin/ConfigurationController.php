<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
  public function edit()
  {
      return view('admin.configuration.edit');
  }

  public function update()
  {
      return redirect('admin/configuration/edit');
  }
}
