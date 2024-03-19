<?php

namespace app\controllers;

use app\library\controllers\Controller;

class ServiceController extends Controller
{
  public function create()
  {
    return view('add', [
      'title' => 'Adicionar'
    ])
    ->extends('main')
    ->css(['form'])
    ->scripts('phoneMask');
  }

  public function store()
  {
    ServiceStore::service_store();
  }
}
