<?php

require_once __DIR__.'/../vendor/autoload.php';

// require __DIR__.'/../app/config/prod.php';
$app = require __DIR__.'/../app/app.php';

require __DIR__.'/../app/controllers.php';

$app['http_cache']->run();
