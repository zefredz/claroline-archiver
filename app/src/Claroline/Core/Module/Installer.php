<?php

namespace Claroline\Module;

use Claroline\Core\ModuleInterface;

class Installer {

  protected $app;

  public function __construct( $app ) {

    $this->app = $app;
  }

  public function install( \Claroline\Core\Module\ModuleInterface $module ) {

    $schema = $this->app['db']->getSchemaManager()->createSchema();

    $plateform = $this->app['db']->getDatabasePlatform();

    $schema = $module->schema( $schema );

    $createQueries = $schema->toSql($platform);

    foreach ( $createQueries as $query ) {
      $app['db']->executeQuery( $query );
    }
  }
}
