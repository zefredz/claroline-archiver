<?php

$core = new Claroline\Core\Controller\ControllerProvider();
$app->register($core);
$app->mount('/', $core);

$archiver = new Claroline\Archiver\Controller\ControllerProvider();
$app->register($archiver);
$app->mount('/archiver', $archiver);

$kudos = new Claroline\Kudos\Controller\ControllerProvider();
$app->register( $kudos );
$app->mount('/kudos', $kudos );
