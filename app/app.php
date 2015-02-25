<?php

/**
 * @file Web based/RESTful application
 */

use Silex\Application;
use Sjdaws\Silluminate\DatabaseDataCollectorServiceProvider;

$app = new Application();

/***********************************************
 * Load configuration
 ***********************************************/

$app['claroline.app.path'] = __DIR__;
$app['claroline.modules.path'] = __DIR__ . '/modules';

$environment = getenv('APP_ENV') ?: 'development';

// Common configuration options for all environments
$app->register(
  new \Igorw\Silex\ConfigServiceProvider(__DIR__."/config/common.json", array(
      'base_path' => __DIR__.'/..'
  ))
);
// Envirnoment specific options
$app->register(
  new \Igorw\Silex\ConfigServiceProvider(__DIR__."/config/$environment.json")
);

/***********************************************
 * Misc
 ***********************************************/

if ( $app['claroline.debug'] === true ) {
  \Symfony\Component\Debug\Debug::enable();
}

/***********************************************
 * Register service providers
 ***********************************************/
 $app->register(new \Silex\Provider\UrlGeneratorServiceProvider());
 $app->register(new \Silex\Provider\HttpFragmentServiceProvider());

// Enable log
$app->register(new \Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => $app['log.path'].'/'.$environment.'.log',
    'monolog.level' => $app['claroline.log.level']
  )
);
// This should be moved in the install console command
if ( ! file_exists(dirname($app['monolog.logfile'])) ) {
  mkdir(dirname($app['monolog.logfile']));
}
// Enable providers for controllers
$app->register(new \Silex\Provider\ServiceControllerServiceProvider());
// Enable HTTP caching
$app->register(new \Silex\Provider\HttpCacheServiceProvider());
// Enable translations
$app->register(new \Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
  )
);
// Enable form API
$app->register(new \Silex\Provider\FormServiceProvider());
// Enable template engine
$app->register(
  new Silex\Provider\TwigServiceProvider(), array(
    'twig.options' => array(
      'cache' => $app['claroline.use_cache'] ? $app['twig.options.cache'] : false,
      'strict_variables' => true
    ),
    'twig.path' => array(__DIR__ . '/views')
  )
);
// Enable database
//
$app['db.config'] = array(
  'default' => 'main',
  'connections' => array(
    'main' => $app['claroline.db_options']
  )
);

$app->register(new \Sjdaws\Silluminate\DatabaseServiceProvider());

/// debug

if ( $environment === 'development' ) {
  $app->register(new \Silex\Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../tmp/cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
  ));
  $app->register(new \Sjdaws\Silluminate\DatabaseDataCollectorServiceProvider());
}

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
