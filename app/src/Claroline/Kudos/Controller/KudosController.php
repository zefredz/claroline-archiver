<?php

namespace Claroline\Kudos\Controller;

class KudosController {

  protected $app;

  public function __construct( $app ) {
    $this->app = $app;
  }

  public function index() {
    return $this->app->render('index.html.twig');
  }
}
