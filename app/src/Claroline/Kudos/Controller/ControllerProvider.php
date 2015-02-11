<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Monolog\Logger;

use Claroline\Kudos\Controller\KudosController;

class ControllerProvider implements ControllerProviderInterface {

  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Loading claroline-kudos main controller', array(), Logger::DEBUG);

    $app['claroline-kudos.kudos-controller'] = $app->share(function() use ($app) {
        return new KudosController($app);
    });

    $controllers->get('/', "claroline-kudos.kudos-controller:index");

    return $controllers;
  }
}
