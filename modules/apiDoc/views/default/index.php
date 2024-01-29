<?php

use app\modules\apiDoc\assets\SwaggerAsset;
use yii\helpers\Json;

/* @var $this \yii\web\View */
/* @var $restUrl string */

$bundle = SwaggerAsset::register($this);

/** @var string $configurations */
/** @var string $title */
/** @var array $oauthConfiguration */
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <?php $this->head(); ?>
    <link rel="icon" type="image/png" href="<?= $bundle->baseUrl ?>/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= $bundle->baseUrl ?>/favicon-16x16.png" sizes="16x16" />
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>

<body>
    <?php $this->beginBody(); ?>

    <div id="swagger-ui"></div>
    <script>
        window.onload = function() {
            // Build a system
            window.ui = SwaggerUIBundle(<?= $configurations ?>);
            <?php if ($oauthConfiguration) : ?>
                window.ui.initOAuth(<?= Json::encode($oauthConfiguration) ?>);
            <?php endif; ?>
        }
    </script>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>