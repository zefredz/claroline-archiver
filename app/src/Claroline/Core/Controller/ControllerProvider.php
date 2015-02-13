<?php

namespace Claroline\Core\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

use Claroline\Core\Controller\IndexController;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app['claroline.controller'] = $app->share(function() use ($app) {
        return new IndexController($app);
    });
  }

  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/', "claroline.controller:index");

    return $controllers;
  }
}
