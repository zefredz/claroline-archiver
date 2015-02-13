<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app['claroline-archiver.controller'] = $app->share(function() use ($app) {
        return new ArchiverController($app);
    });
  }


  public function connect( Application $app ) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/course', "claroline-archiver.controller:loadCourse");

    return $controllers;
  }
}
