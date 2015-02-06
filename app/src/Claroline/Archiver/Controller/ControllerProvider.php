<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use Claroline\Archiver\Controller\IndexController;

class ControllerProvider implements ControllerProviderInterface {

  public function connect(Application $app) {

    $app['homepage.controller'] = $app->share(function() use ($app) {
        return new IndexController($app);
    });

    // creates a new controller based on the default route
    $controllers = $app['controllers_factory'];

    $controllers->get('/', "homepage.controller:index");

    return $controllers;
  }
}
