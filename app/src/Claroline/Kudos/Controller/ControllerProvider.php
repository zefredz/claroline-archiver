<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

use Claroline\Kudos\Controller\KudosController;

class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  public function boot( Application $app ) {

  }

  public function register( Application $app ) {

    $app['claroline-kudos.kudos-controller'] = $app->share(function() use ($app) {
        return new KudosController($app);
    });
  }

  public function connect( Application $app ) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/', "claroline-kudos.kudos-controller:index");

    return $controllers;
  }
}
