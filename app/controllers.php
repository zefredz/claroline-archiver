<?php

use Claroline\Archiver\Controller\IndexController;

/*$app->match('/', function() use ($app) {
  return $app['twig']->render('index.html.twig');
})->bind('homepage');*/

$app['homepage.controller'] = $app->share(function() use ($app) {
    return new IndexController($app);
});

$app->get('/', "homepage.controller:index");
