<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Monolog\Logger;

use Claroline\Archiver\Controller\IndexController;

class ControllerProvider implements ControllerProviderInterface {

  public function connect(Application $app) {

    // creates a new controller based on the default route
    $controllers = $app['controllers_factory'];

    $app->log('Loading homepage controller', array(), Logger::DEBUG);

    $app['homepage.controller'] = $app->share(function() use ($app) {
        return new IndexController($app);
    });

    $controllers->get('/', "homepage.controller:index");

    $app->log('Loading archiver controller', array(), Logger::DEBUG);

    $app['archiver.controller'] = $app->share(function() use ($app) {
        return new ArchiverController($app);
    });

    $controllers->get('/course', "archiver.controller:loadCourse");

    return $controllers;
  }
}
