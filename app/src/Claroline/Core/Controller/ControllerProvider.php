<?php

namespace Claroline\Core\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

use Claroline\Core\Controller\IndexController;

/**
 * Implements the ControllerProviderInterface and ServiceProviderInterface for the
 * claroline core
 * @package claroline-core
 */
class ControllerProvider implements ControllerProviderInterface, ServiceProviderInterface {

  /**
   * @param  Silex\Application $app [description]
   * @see Silex\ServiceProviderInterface
   */
  public function boot( Application $app ) {

  }

  /**
   * @param  Silex\Application $app
   * @see Silex\ServiceProviderInterface
   */
  public function register( Application $app ) {

    $app['claroline.controller'] = $app->share(function() {
        return new IndexController();
    });
  }

  /**
   * @param  Silex\Application $app
   * @see Silex\ControllerProviderInterface
   */
  public function connect(Application $app) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/', "claroline.controller:index");

    return $controllers;
  }
}
