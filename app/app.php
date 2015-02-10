<?php

$app = new \Claroline\Application();

/***********************************************
 * Load configuration
 ***********************************************/

$environment = getenv('APP_ENV') ?: 'development';

$app->register(
  new Igorw\Silex\ConfigServiceProvider(
    __DIR__."/config/common.json", array(
      'base_path' => __DIR__.'/..')
  )
);
$app->register(
  new Igorw\Silex\ConfigServiceProvider(
    __DIR__."/config/$environment.json")
);

/***********************************************
 * Misc
 ***********************************************/

if ( $app['claroline.debug'] === true ) {
  Symfony\Component\Debug\Debug::enable();
}

/***********************************************
 * Register service providers
 ***********************************************/
$app->register(
  new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/'.$environment.'.log',
    'monolog.level' => $app['claroline.log.level']
));
// This should be moved in the install console command
if ( ! file_exists(dirname($app['monolog.logfile'])) ) {
  mkdir(dirname($app['monolog.logfile']));
}
$app->register(
  new Silex\Provider\ServiceControllerServiceProvider());
$app->register(
  new Silex\Provider\HttpCacheServiceProvider());
$app->register(
  new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));
$app->register(
  new Silex\Provider\FormServiceProvider());
$app->register(
  new Silex\Provider\TwigServiceProvider(), array(
    'twig.options' => array(
      'cache' => $app['claroline.use_cache'] ? $app['twig.options.cache'] : false,
      'strict_variables' => true
    ),
    'twig.path' => array(__DIR__ . '/views')
));
$app->register(
  new \Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $app['claroline.db_options'])
);

/***********************************************
 * Register controllers
 ***********************************************/

require __DIR__.'/../app/controllers.php';

/***********************************************
 * Serve the pages
 ***********************************************/

if ( $app['claroline.use_cache'] === true ) {
  return $app['http_cache'];
}
else {
  return $app;
}
