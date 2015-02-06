<?php

use Claroline\Archiver\Controller\IndexController;

$app['homepage.controller'] = $app->share(function() use ($app) {
    return new IndexController($app);
});

$app->get('/', "homepage.controller:index");
