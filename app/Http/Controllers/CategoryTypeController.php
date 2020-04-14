<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryTypeController extends Controller
{
  public function index()
  {
    return Category::select(['id', 'name'])->orderBy('id')->get();
  }
}
