<?php

namespace Claroline\Archiver\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

/**
 * Implements the ControllerProviderInterface and ServiceProviderInterface for the
 * claroline-archiver module
 * @package claroline-archiver
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

    $app['claroline-archiver.controller'] = $app->share(function() {
        return new ArchiverController();
    });
  }

  /**
   * @param  Silex\Application $app
   * @see Silex\ControllerProviderInterface
   */
  public function connect( Application $app ) {

    $controllers = $app['controllers_factory'];

    $controllers->get('/', "claroline-archiver.controller:index");
    $controllers->get('/course', "claroline-archiver.controller:loadCourse");

    return $controllers;
  }
}
