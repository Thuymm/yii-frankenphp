<?php

namespace app\modules\v1\controllers;

class AuthController extends \yii\rest\ActiveController
{
  public $modelClass = 'app\models\UserIdentity';

  // public $serializer = [
  //   'class' => 'yii\rest\Serializer',
  //   'collectionEnvelope' => 'items',
  // ];

  public function behaviors()
  {
    $behaviors = parent::behaviors();
    return $behaviors;
  }
}
