<?php

namespace Claroline\Core\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;
use Monolog\Logger;

use Claroline\Core\Controller\IndexController;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app->log('Register claroline main controller', array(), Logger::DEBUG);

    $app['claroline.controller'] = $app->share(function() use ($app) {
        return new IndexController($app);
    });
  }

  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Register routes for claroline main controller', array(), \Monolog\Logger::DEBUG);

    $controllers->get('/', "claroline.controller:index");

    return $controllers;
  }
}
