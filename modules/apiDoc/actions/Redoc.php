<?php

namespace app\modules\apiDoc\actions;

use yii\base\Action;
use yii\helpers\Url;
use yii\web\Response;

class Redoc extends Action
{
  /**
   * @var string|array The rest url configuration.
   * Check documentation for more information.
   * @see https://github.com/swagger-api/swagger-ui/blob/master/docs/usage/configuration.md
   */
  public $restUrl;

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
  public function run()
  {
    \Yii::$app->getResponse()->format = Response::FORMAT_HTML;
    $this->controller->layout = false;
    $view = $this->controller->getView();
    if ($this->restUrl) {
      $restUrl = $this->restUrl;
    } else {
      $restUrl = $this->module->jsonUrl ?: Url::to(['default/json']);
    }
    return $view->renderFile(__DIR__ . '/../views/default/redoc.php', [
      'restUrl' => $restUrl,
    ], $this->controller);
  }
}
