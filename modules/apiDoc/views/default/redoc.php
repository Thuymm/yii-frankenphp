<?php

/** @var string $url */

$this->title = 'Redoc UI';
?>
<!DOCTYPE html>
<html>

<head>
  <title>ReDoc</title>
  <!-- needed for adaptive design -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--
    ReDoc doesn't change outer page styles
    -->
  <style>
    body {
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <redoc spec-url='<?= $restUrl ?>'></redoc>
  <script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"> </script>
</body>

</html>