<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;
use Monolog\Logger;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app->log('Register claroline-archiver controller', array(), Logger::DEBUG);

    $app['claroline-archiver.controller'] = $app->share(function() use ($app) {
        return new ArchiverController($app);
    });
  }


  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Register routes for claroline-archiver controller', array(), Logger::DEBUG);

    $controllers->get('/course', "claroline-archiver.controller:loadCourse");

    return $controllers;
  }
}
