<?php

namespace Claroline\Core\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Monolog\Logger;

use Claroline\Core\Controller\IndexController;

class ControllerProvider implements ControllerProviderInterface {

  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Loading claroline controller', array(), \Monolog\Logger::DEBUG);

    $app['claroline.controller'] = $app->share(function() use ($app) {
        return new IndexController($app);
    });

    $controllers->get('/', "claroline.controller:index");

    return $controllers;
  }
}
