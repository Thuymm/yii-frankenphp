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
            'api' => [
                'class' => 'app\modules\apiDoc\actions\SwaggerDoc',
                'restUrl' => Url::to(['default/json'], true),
            ],
            'doc' => [
                'class' => 'app\modules\apiDoc\actions\Redoc',
                'restUrl' => Url::to(['default/json'], true),
            ],
            'json' => [
                'class' => 'app\modules\apiDoc\actions\OpenApiRenderer',
                'scanDir' => [
                    '@app/modules/v1/controllers',
                    '@app/modules/v1/models',
                ],
                'cache' => 'cache',
                'cacheKey' => 'api-swagger-cache',
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
