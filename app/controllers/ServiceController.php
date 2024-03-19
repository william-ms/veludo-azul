<?php

namespace app\controllers;

use app\database\models\ServiceModel;
use app\library\controllers\Controller;
use app\library\database\actions\Delete;
use app\library\database\actions\FindBy;

class ServiceController extends Controller
{
  public function index(array $args)
  {
    if(!session_has('service'))
    {
      $service = (new ServiceModel)->execute(new FindBy('id', $args['service']));
      session_set('service', $service);
    }
    else
    {
      $service = session_get('service');
    }

    return view('service', [
      'title' => 'Serviço',
      'service' => $service
    ])
    ->extends('main')
    ->css(['service', 'modal'])
    ->scripts('modal');
  }

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

  public function update(array $args)
  {
    ServiceUpdate::service_update($args['update']);
  }

  public function destroy(array $args)
  {
    (new ServiceModel)->execute(new Delete('id', '=', $args['service']));
    redirect('/');
  }
}
