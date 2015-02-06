<?php

namespace Claroline\Archiver\Controller;

class IndexController {

    protected $app;

    public function __construct( $app ) {
        $this->app = $app;

    }

    public function index() {
        
        if ( func_num_args() ) {
            var_dump(func_get_args());
        }

        return $this->app['twig']->render('index.html.twig');
    }
}
