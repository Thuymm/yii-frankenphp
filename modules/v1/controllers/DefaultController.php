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
                'class' => 'app\modules\apiDoc\actions\SwaggerDoc',
                'restUrl' => Url::to(['/v1/default/json'], true),
            ],
            'api' => [
                'class' => 'app\modules\apiDoc\actions\Redoc',
                'restUrl' => Url::to(['/v1/default/json'], true),
            ],
            'json' => [
                'class' => 'app\modules\apiDoc\actions\OpenApiRenderer',
                'scanDir' => [
                    '@app/modules/v1/controllers',
                    '@app/modules/v1/models',
                ],
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
