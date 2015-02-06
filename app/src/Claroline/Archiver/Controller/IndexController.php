<?php

namespace Claroline\Archiver\Controller;

class IndexController {

  protected $app;

  public function __construct( $app ) {
    $this->app = $app;
  }

  public function index() {
    return $this->app['twig']->render('index.html.twig');
  }
}
