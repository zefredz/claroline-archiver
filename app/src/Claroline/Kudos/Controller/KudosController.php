<?php

namespace Claroline\Kudos\Controller;

use Silex\Application;

class KudosController {

  protected $app;

  public function __construct( Application $app ) {
    $this->app = $app;
  }

  public function index() {
    return $this->app['twig']->render('index.html.twig');
  }
}
