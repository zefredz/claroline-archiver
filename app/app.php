<?php

$app = new \Claroline\Application();

require __DIR__ .'/config/common.php';

$environment = isset( $app['claroline.env'] ) ? $app['claroline.env'] : 'production';

if (  isset ( $app['claroline.allowedenv'][$environment] ) ) {
  include __DIR__ . '/config/' . $environment . '.php';
  $app['claroline.env'] = $environment;
}

if ( $app['claroline.debug'] === true ) {
  Symfony\Component\Debug\Debug::enable();
}

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/'.$app['claroline.env'].'.log',
));

if ( ! file_exists(dirname($app['monolog.logfile'])) ) {
  mkdir(dirname($app['monolog.logfile']));
}

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\HttpCacheServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.options' => array(
    'cache' => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
    'strict_variables' => true
  ),
  // 'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
  'twig.path' => array(__DIR__ . '/views')
));

require __DIR__.'/../app/controllers.php';

if ( $app['claroline.env'] === 'production' ) {
  return $app['http_cache'];
}
else {
  return $app;
}
