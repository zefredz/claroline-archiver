<?php

return function ( \Silex\Application $app ) {
  $archiver = new \Claroline\Archiver\Controller\ControllerProvider();
  $app->register($archiver);
  $app->mount('/archiver', $archiver);

  return 'claroline-archiver';
};
