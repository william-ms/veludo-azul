<?php
  namespace app\controllers;

  use app\library\controllers\Controller;
  use app\database\models\ServiceModel;
  use app\library\validate\Validate;
  use app\library\database\actions\Update;

  class ServiceUpdate extends Controller
  {
    public static function service_update()
    {
      $service = session_get('service');

      $validate = new Validate();

      $validate->handle([
        'firstName' => 'REQUIRED',
        'lastName' => 'REQUIRED',
        'phoneNumber' => 'REQUIRED',
        'description' => 'REQUIRED',
        'value' => 'REQUIRED',
        'dateOutput' => 'REQUIRED'
      ]);

      if ($validate->errors)
      {
        return redirect('/edit');
      }

      $service->firstName = $validate->data['firstName'];
      $service->lastName = $validate->data['lastName'];
      $service->phoneNumber = $validate->data['phoneNumber'];
      $service->description = $validate->data['description'];
      $service->value = $validate->data['value'];
      $service->dateOutput = $validate->data['dateOutput'];
    
      (new ServiceModel)->execute(new Update($service));
      session_set('service', $service);

      redirect("/service/{$service->id}");
    }
  }