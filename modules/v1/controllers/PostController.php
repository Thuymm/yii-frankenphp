<?php

namespace app\modules\v1\controllers;

use app\models\Post;
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

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['custom'] = ['GET'];
        return $verbs;
    }

    public function actionCustom()
    {
        $post = new Post();
        $post->title = "Custom Title";
        $post->body = "Custom Body";
        $post->save();
        return [
            'post' => $post,
            'message' => 'custom'
        ];
    }
}
