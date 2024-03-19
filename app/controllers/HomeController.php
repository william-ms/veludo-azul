<?php

namespace app\controllers;

use app\library\controllers\Controller;

class HomeController extends Controller
{
  public function index(array $args)
  {
    return view('home', [
      'title' => 'Home'
    ])->extends('main');
  }
}