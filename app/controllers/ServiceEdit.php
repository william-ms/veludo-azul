<?php

namespace app\controllers;

use app\database\models\ServiceModel;
use app\library\database\actions\Update;

class ServiceEdit
{
  public static function service_edit(mixed $args)
  {
    $service = session_get('service');

    if($args === 'description')
    {
      return view('edit', [
        'title' => 'Editar',
        'service' => $service
      ])->extends('main')->css('form');
    }

    $service = match($args)
    {
      'status' => self::edit_status($service),
      'payment' => self::edit_payment($service),
    };

    (new ServiceModel)->execute(new Update($service));
    session_set('service', $service);

    return redirect("/service/{$service->id}");
  }

  private static function edit_status($service)
  {
    match($service->status)
    {
      'prateleira' => $service->status = 'pronto',
      'pronto' => $service->status = 'entregue',
      'entregue' => $service->status = 'prateleira'
    };

    return $service;
  }

  private static function edit_payment($service)
  {
    $service->received = ($service->received === "false") ? "true" : "false";
    
    return $service;
  }
}
