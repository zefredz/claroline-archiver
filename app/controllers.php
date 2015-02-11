<?php

$app->mount('/', new Claroline\Core\Controller\ControllerProvider());

$app->mount('/archiver', new Claroline\Archiver\Controller\ControllerProvider());

$app->mount('/kudos', new Claroline\Kudos\Controller\ControllerProvider());
