<?php

namespace app\modules\v1\controllers;

use yii\web\Response;

class PostController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Post';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    public function beforeAction($action)
    {
        \Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}
