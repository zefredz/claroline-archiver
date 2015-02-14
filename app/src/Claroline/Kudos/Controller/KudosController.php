<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;

/**
 * Kudos controller
 * @package claroline-kudos
 */
class KudosController {

  /**
   * Serve the index page of the kudos module
   * @param  Silex\Application $app
   * @return page output
   */
  public function index(Application $app) {
    return $app['twig']->render('index.html.twig');
  }
}
