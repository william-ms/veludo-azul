<?php
  namespace app\controllers;

  use app\library\controllers\Controller;
  use app\database\models\ServiceModel;
  use app\library\database\actions\Update;

  class ServiceUpdate extends Controller
  {
    public static function service_update($param)
    {
      $service = session_get('service');

      if($param === "payment")
      {
        $service->received = ($service->received === "false") ? "true" : "false";
      }
      else if($param === "status")
      {
        $service = self::status($service);
      }
      else if($param === "description")
      {
        
      }

      (new ServiceModel)->execute(new Update($service));
      session_set('service', $service);

      return redirect('\\service\\'.$service->id);
    }

    public static function status($service)
    {
      if($service->status === 'prateleira')
      {
        $service->status = 'pronto';
      }
      else if($service->status === 'pronto')
      {
        $service->status = 'entregue';
      }
      else if($service->status === 'entregue')
      {
        $service->status = 'prateleira';
      }

      return $service;
    }
  }