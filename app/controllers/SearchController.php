<?php

namespace app\controllers;

use app\database\models\ServiceModel;
use app\library\controllers\Controller;
use app\library\database\actions\FindAll;
use app\library\database\Query;
use app\library\validate\Validate;

class SearchController extends Controller
{
  public function index(array $args)
  {
    $services = '';

    if(session_has('services'))
    {
      $services = session_get('services');
      session_remove('services');
    }

    return view('search', [
      'title' => 'Procurar',
      'services' => $services
    ])->extends('main')->css(['form', 'list']);
  }

  public function show(array $args)
    {
      $validate = new Validate;
      $validate->handle([
        'firstName' => 'REQUIRED',
        'lastName' => 'REQUIRED'
      ]);

      if ($validate->errors)
      {
        return redirect('/search');
      }

      $firstName = $validate->data['firstName'];
      $lastName = $validate->data['lastName'];

      $query = (new Query)->where('firstName', '=', $firstName, 'and')->where('lastName', '=', $lastName);

      $services = (new ServiceModel)->execute(new FindAll($query));
      session_set('services', $services);

      return redirect('/search');
    }
}
