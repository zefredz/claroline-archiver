<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Monolog\Logger;

class ControllerProvider implements ControllerProviderInterface {

  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Loading claroline-archiver controller', array(), Logger::DEBUG);

    $app['claroline-archiver.controller'] = $app->share(function() use ($app) {
        return new ArchiverController($app);
    });

    $controllers->get('/course', "claroline-archiver.controller:loadCourse");

    return $controllers;
  }
}
