<?php

require_once __DIR__.'/../vendor/autoload.php';

Symfony\Component\Debug\Debug::enable();

$env = 'development';
$app = require __DIR__.'/../app/app.php';

require __DIR__.'/../app/controllers.php';

$app->run();
