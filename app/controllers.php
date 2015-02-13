<?php

use Symfony\Component\Finder\Finder;

$core = new Claroline\Core\Controller\ControllerProvider();
$app->register($core);
$app->mount('/', $core);

// load modules

$moduleLoader = new Claroline\Core\Module\Loader();
$moduleLoader->load( $app );
