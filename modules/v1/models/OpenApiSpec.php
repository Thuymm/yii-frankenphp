<?php

namespace app\modules\v1\models;

use OpenApi\Attributes as OA;

#[OA\Info(
  version: '1.0.0',
  title: 'Yii Rest Api',
  attachables: [new OA\Attachable()]
)]
#[OA\Server('/v1', 'version 1')]
#[OA\License(name: 'MIT')]
class OpenApiSpec
{
}
