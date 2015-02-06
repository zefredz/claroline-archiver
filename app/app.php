<?php

$app = new Silex\Application();

if ( $env === 'development' ) {
  require __DIR__ .'/config/dev.php';
}
else {
  require __DIR__ .'/config/prod.php';
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

return $app;
