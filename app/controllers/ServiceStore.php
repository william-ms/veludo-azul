<?php
  namespace app\controllers;

  use app\library\controllers\Controller;
  use app\library\validate\Validate;
  use app\database\entities\ServiceEntity;
  use app\database\models\ServiceModel;
  use app\library\database\actions\Insert;

  class ServiceStore extends Controller
  {
    public static function service_store()
    {
      $validate = new Validate();

      $validate->handle([
        'firstName' => 'REQUIRED',
        'lastName' => 'REQUIRED',
        'phoneNumber' => 'REQUIRED',
        'description' => 'REQUIRED',
        'value' => 'REQUIRED',
        'dateOutput' => 'REQUIRED'
      ]);

      if($validate->errors)
      {
        return redirect('/service/create');
      }
      
      if(!str_contains($validate->data['value'], ','))
      {
        $validate->data['value'] .= ',00';
      }

      $service = new ServiceEntity;
      $service->firstName = $validate->data['firstName'];
      $service->lastName = $validate->data['lastName'];
      $service->phoneNumber = $validate->data['phoneNumber'];
      $service->description = $validate->data['description'];
      $service->value = $validate->data['value'];
      $service->received = 'false';
      $service->status = 'prateleira';
      $service->dateInput = date('Y-m-d');
      $service->dateOutput = $validate->data['dateOutput'];

      (new ServiceModel)->execute(new Insert($service));

      return redirect('/');
    }
  }