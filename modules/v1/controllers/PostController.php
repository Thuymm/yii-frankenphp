<?php

namespace app\modules\v1\controllers;

use app\models\Post;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Yii Rest Api',
    attachables: [new OA\Attachable()]
)]
#[OA\Server('/v1', 'version 1')]
#[OA\Server('/v2', 'version 2')]
#[OA\License(name: 'MIT')]
#[OA\Tag(name: 'post', attachables: [new OA\Attachable(),])]
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

    #[OA\Get(path: '/post', tags: ['post'])]
    #[OA\Response(null, 200, '')]
    public function actionIndex()
    {
        return parent::actionIndex();
    }
}
