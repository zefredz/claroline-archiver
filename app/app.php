<?php

$app = new \Claroline\Application();

$environment = getenv('APP_ENV') ?: 'development';

$app->register(new Igorw\Silex\ConfigServiceProvider(
  __DIR__."/config/common.json", array('base_path' => __DIR__.'/..'))
);
$app->register(new Igorw\Silex\ConfigServiceProvider(
  __DIR__."/config/$environment.json")
);

if ( $app['claroline.debug'] === true ) {
  Symfony\Component\Debug\Debug::enable();
}

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/'.$environment.'.log',
));

if ( ! file_exists(dirname($app['monolog.logfile'])) ) {
  mkdir(dirname($app['monolog.logfile']));
}

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\HttpCacheServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.options' => array(
    'cache' => $app['claroline.use_cache'] ? $app['twig.options.cache'] : false,
    'strict_variables' => true
  ),
  // 'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
  'twig.path' => array(__DIR__ . '/views')
));

$app->register(new \Silex\Provider\DoctrineServiceProvider(),
  array('db.options' => $app['claroline.db_options'])
);

require __DIR__.'/../app/controllers.php';

if ( $app['claroline.use_cache'] === true ) {
  return $app['http_cache'];
}
else {
  return $app;
}
