<?php

return function ( \Silex\Application $app ) {
  $kudos = new \Claroline\Kudos\Controller\ControllerProvider();
  $app->register( $kudos );
  $app->mount('/kudos', $kudos );

  return 'claroline-kudos';
};
