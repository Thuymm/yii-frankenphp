<?php

namespace app\modules\apiDoc\actions;

use OpenApi\Annotations\OpenApi;
use OpenApi\Generator;
use OpenApi\Util;
use Yii;
use yii\base\Action;
use yii\base\ExitException;
use yii\caching\Cache;
use yii\caching\CacheInterface;
use yii\di\Instance;
use yii\web\Response;
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
   * @var Cache|string|null the cache object or the ID of the cache application component that is used to store
   * Cache the \Swagger\Scan
   */
  public $cache = 'cache';
  /**
   * @var bool If enable caching the scan result.
   * @since 2.0.0
   */
  public $enableCache = false;
  /**
   * @var string Cache key
   * [[cache]] must not be null
   */
  public $cacheKey = 'api-swagger-cache';

  /**
   * @inheritdoc
   */
  public function init(): void
  {
    $this->cache = Instance::ensure($this->cache, CacheInterface::class);

    $this->enableCORS();
  }

  /**
   * @inheritdoc
   */
  public function run(): Response
  {
    $this->clearCache();

    if ($this->enableCache) {
      if (($swagger = $this->cache->get($this->cacheKey)) === false) {
        $swagger = $this->getSwaggerDocumentation();
        $this->cache->set($this->cacheKey, $swagger);
      }
    } else {
      $swagger = $this->getSwaggerDocumentation();
    }

    return $this->controller->asJson($swagger);
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
   *
   * @throws ExitException
   */
  protected function clearCache()
  {
    $clearCache = Yii::$app->getRequest()->get('clear-cache', false);
    if ($clearCache !== false) {
      $this->cache->delete($this->cacheKey);

      Yii::$app->response->content = 'Succeed clear swagger api cache.';
      Yii::$app->end();
    }
  }

  /**
   * Enable CORS
   */
  protected function enableCORS(): void
  {
    $headers = Yii::$app->getResponse()->getHeaders();

    $headers->set('Access-Control-Allow-Headers', 'Content-Type, api_key, Authorization');
    $headers->set('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT, PATCH');
    $headers->set('Access-Control-Allow-Origin', '*');
  }
}
