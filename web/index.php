<?php

require_once __DIR__.'/../vendor/autoload.php';

$env = 'production';
$app = require __DIR__.'/../app/app.php';

require __DIR__.'/../app/controllers.php';

$app['http_cache']->run();
