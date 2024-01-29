<?php

namespace app\modules\apiDoc\controllers;

use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'json' => [
                'class' => 'app\modules\apiDoc\actions\OpenApiRenderer',
                // Тhe list of directories that contains the swagger annotations.
                'scanDir' => $this->module->scanDir,
            ],
            'index' => [
                'class' => 'app\modules\apiDoc\actions\SwaggerDoc',
                'restUrl' => Url::to(['default/json']),
            ],
            'redoc' => [
                'class' => 'app\modules\apiDoc\actions\Redoc',
                'restUrl' => Url::to(['default/json']),
            ]
        ];
    }
}
