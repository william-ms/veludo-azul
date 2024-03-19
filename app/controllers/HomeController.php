<?php

namespace app\controllers;

use app\database\models\ServiceModel;
use app\library\controllers\Controller;
use app\library\database\actions\FindAll;
use app\library\database\Query;

class HomeController extends Controller
{
  public function index(array $args)
  {
    if(!session_has('date'))
    {
      session_set('date', date('Y-m-d'));
    }

    if(session_has('service'))
    {
      session_remove('service');
    }

    $query = (new Query)->where('dateOutput', '=', session_get('date'));
    $services = (new ServiceModel)->execute(new FindAll($query));
    $date = explode('-', session_get('date'));

    return view('home', [
      'title' => 'Home',
      'services' => $services,
      'date' => $date
    ])
    ->extends('main')
    ->css(['home', 'list']);
  }
}