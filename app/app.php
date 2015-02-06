<?php

use Silex\Provider\HttpCacheServiceProvider;

$app = new Silex\Application();

require __DIR__ .'/config/prod.php';

$app->register(new HttpCacheServiceProvider());

return $app;
