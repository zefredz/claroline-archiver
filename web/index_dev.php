<?php

require_once __DIR__.'/../vendor/autoload.php';

Symfony\Component\Debug\Debug::enable();

// require __DIR__.'/../app/config/dev.php';
$app = require __DIR__.'/../app/app.php';

require __DIR__.'/../app/controllers.php';

$app->run();
