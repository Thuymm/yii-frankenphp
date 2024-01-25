<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{

    public function actions()
    {
        return [
            'doc' => [
                'class' => 'light\swagger\SwaggerAction',
                'restUrl' => Url::to(['/v1/default/api'], true),
            ],
            'api' => [
                'class' => 'light\swagger\SwaggerApiAction',
                'scanDir' => [
                    Yii::getAlias('@app/modules/v1/controllers'),
                ],
                'api_key' => 'test'
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
