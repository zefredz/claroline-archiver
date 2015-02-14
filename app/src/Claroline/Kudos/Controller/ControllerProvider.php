<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

use Claroline\Kudos\Controller\KudosController;

/**
 * Implements the ControllerProviderInterface and ServiceProviderInterface for the
 * claroline-kudos module
 * @package claroline-kudos
 */
class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  /**
   * @param  Silex\Application $app [description]
   * @see Silex\ServiceProviderInterface
   */
  public function boot( Application $app ) {

  }

  /**
   * @param  Silex\Application $app [description]
   * @see Silex\ServiceProviderInterface
   */
  public function register( Application $app ) {

    $app['claroline-kudos.kudos-controller'] = $app->share(function() {
        return new KudosController();
    });
  }

  /**
   * @param  Silex\Application $app
   * @see Silex\ControllerProviderInterface
   */
  public function connect( Application $app ) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/', "claroline-kudos.kudos-controller:index");

    return $controllers;
  }
}
