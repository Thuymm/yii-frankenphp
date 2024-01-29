<?php

use app\modules\apiDoc\assets\SwaggerAsset;

/* @var $this \yii\web\View */
/* @var $restUrl string */

SwaggerAsset::register($this);
$assetUrl = $this->getAssetManager()->getBundle(SwaggerAsset::class)->baseUrl;
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <?php $this->head(); ?>
    <link rel="icon" type="image/png" href="<?= $assetUrl ?>/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= $assetUrl ?>/favicon-16x16.png" sizes="16x16" />
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
            const ui = SwaggerUIBundle({
                url: "<?= $restUrl; ?>",
                dom_id: '#swagger-ui',
                deepLinking: true,
                jsonEditor: false,
                displayRequestDuration: true,
                filter: true,
                validatorUrl: null,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout"
            });
            window.ui = ui
        }
    </script>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>