<?php

use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new Silex\Application();

require __DIR__ .'/config/prod.php';

$app->register(new HttpCacheServiceProvider());

$app->register(new TwigServiceProvider(), array(
  'twig.options'        => array(
    'cache'            => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
    'strict_variables' => true
  ),
  // 'twig.form.templates' => array('form_div_layout.html.twig', 'common/form_div_layout.html.twig'),
  'twig.path'           => array(__DIR__ . '/views')
));

return $app;
