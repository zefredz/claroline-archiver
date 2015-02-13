<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;
use Monolog\Logger;

use Claroline\Kudos\Controller\KudosController;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app->log('Register claroline-kudos main controller', array(), Logger::DEBUG);

    $app['claroline-kudos.kudos-controller'] = $app->share(function() use ($app) {
        return new KudosController($app);
    });
  }

  public function connect( Application $app ) {

    $controllers = $app['controllers_factory'];

    // creates a new controller based on the default route
    $app->log('Register routes for claroline-kudos main controller', array(), Logger::DEBUG);

    $controllers->get('/', "claroline-kudos.kudos-controller:index");

    return $controllers;
  }
}
