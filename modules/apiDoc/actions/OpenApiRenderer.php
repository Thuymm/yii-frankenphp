<?php

namespace app\modules\apiDoc\actions;

use OpenApi\Annotations\OpenApi;
use Yii;
use yii\base\Action;
use yii\web\Response;
use OpenApi\Generator;
use OpenApi\Util;

/**
 * Class OpenAPIRenderer is responsible for generating the JSON spec.
 *
 */
class OpenAPIRenderer extends Action
{
  /**
   * @var string|array|\Symfony\Component\Finder\Finder The directory(s) or filename(s).
   * If you configured the directory must be full path of the directory.
   */
  public $scanDir;

  /**
   * @var array the options passed to `Swagger`, Please refer the `Swagger\scan` function for more information
   */
  public $scanOptions = [];

  /**
   * @inheritdoc
   */
  public function init(): void
  {
    parent::init();
  }

  /**
   * @inheritdoc
   */
  public function run(): Response
  {
    $this->enableCORS();

    return $this->controller->asJson($this->getSwaggerDocumentation());
  }

  /**
   * Scan the filesystem for swagger annotations and build swagger-documentation.
   *
   * @return OpenApi
   */
  protected function getSwaggerDocumentation(): OpenApi
  {
    $directories = is_array($this->scanDir) ?
      array_map(function (string $path) {
        return Yii::getAlias($path);
      }, $this->scanDir) :
      Yii::getAlias($this->scanDir);
    $openApi = Generator::scan(Util::finder($directories), $this->scanOptions);
    return $openApi;
  }

  /**
   * Enable CORS
   */
  protected function enableCORS(): void
  {
    $headers = Yii::$app->getResponse()->getHeaders();

    $headers->set('Access-Control-Allow-Headers', 'Content-Type, api_key, Authorization');
    $headers->set('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT', 'PATCH');
    $headers->set('Access-Control-Allow-Origin', '*');
  }
}
