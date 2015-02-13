<?php

namespace Claroline\Core\Controller;

use Silex\Application;

class IndexController {

  protected $app;

  public function __construct( Application $app ) {
    $this->app = $app;
  }

  public function index() {
    return $this->app['twig']->render('index.html.twig');
  }
}
