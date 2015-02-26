<?php

/**
 * @file Web based/RESTful application
 */

$app = require_once __DIR__ . '/bootstrap.php';

/***********************************************
 * Register controllers
 ***********************************************/

$core = new \Claroline\Core\Controller\ControllerProvider();
$app->register($core);
$app->mount('/', $core);

// load modules

$moduleLoader = new \Claroline\Core\Module\Loader();
$moduleLoader->load( $app );

/***********************************************
 * Serve the pages
 ***********************************************/

if ( $app['claroline.use_cache'] === true ) {

  return $app['http_cache'];
}
else {

  return $app;
}
