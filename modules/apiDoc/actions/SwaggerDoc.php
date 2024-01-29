<?php

namespace app\modules\apiDoc\actions;

use yii\base\Action;
use yii\helpers\Url;
use yii\web\Response;

class SwaggerDoc extends Action
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
    $restUrl = $this->restUrl;
    if ($this->restUrl) {
      $this->controller->layout = false;
      $view = $this->controller->getView();
      return $view->renderFile(__DIR__ . '/../views/default/index.php', [
        'restUrl' => $restUrl,
      ], $this->controller);
    } else {
      $this->layout = false;
      return $this->render('index', [
        'restUrl' => $restUrl,
      ]);
    }
  }
}
