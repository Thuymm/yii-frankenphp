<?php

namespace app\modules\apiDoc\actions;

use yii\base\Action;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;
use yii\web\JsExpression;
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
   * @var array The OAuth configuration.
   */
  public $oauthConfiguration = [];
  /**
   * @var string The customer asset bundle.
   * @since 2.0.0
   */
  public $additionalAsset;
  /**
   * @var string
   * @since 2.0.0
   */
  public $title = 'Swagger-ui';
  /**
   * @var array The swagger-ui component configurations.
   * @see https://github.com/swagger-api/swagger-ui/blob/master/docs/usage/configuration.md
   * @since 2.0.0
   */
  public $configurations = [];
  /**
   * @var array Default swagger-ui configurations.
   * @since 2.0.0
   */
  protected $defaultConfigurations = [
    'dom_id' => '#swagger-ui',
    'deepLinking' => true,
    'jsonEditor' => true,
    'displayRequestDuration' => true,
    'filter' => true,
    'validatorUrl' => null,
    'presets' => [
      'SwaggerUIBundle.presets.apis',
      'SwaggerUIStandalonePreset',
    ],
    'plugins' => [
      'SwaggerUIBundle.plugins.DownloadUrl',
      'SwaggerUIBundle.plugins.Topbar',
    ],
    'layout' => 'StandaloneLayout',
    'validatorUrl' => null,
  ];

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
    return $view->renderFile(__DIR__ . '/../views/default/index.php', [
      'configurations' => $this->prepareConfiguration(),
      'oauthConfiguration' => $this->oauthConfiguration,
      'title' => $this->title,
    ], $this->controller);
  }

  /**
   * @return string
   */
  protected function prepareConfiguration()
  {
    $configurations = array_merge($this->defaultConfigurations, $this->configurations);

    if ($this->restUrl) {
      $configurations[is_array($this->restUrl) ? 'urls' : 'url'] = $this->restUrl;
    }

    if (isset($configurations['plugins'])) {
      $configurations['plugins'] = array_map(
        [$this, 'convertJsExpression'],
        (array)$configurations['plugins']
      );
    }

    if (isset($configurations['presets'])) {
      $configurations['presets'] = array_map(
        [$this, 'convertJsExpression'],
        (array)$configurations['presets']
      );
    }

    return Json::encode($configurations);
  }

  /**
   * @param string $str
   *
   * @return JsExpression
   */
  protected function convertJsExpression($str)
  {
    return new JsExpression($str);
  }

  /**
   * @inheritdoc
   */
  protected function beforeRun()
  {
    if ($this->additionalAsset != null) {
      $additionalAsset = $this->additionalAsset;
      if (class_exists($additionalAsset) and method_exists($additionalAsset, 'register')) {
        $additionalAsset::register($this->controller->getView());
      } else {
        throw new InvalidArgumentException('Not valid class');
      }
    }

    return parent::beforeRun();
  }
}
