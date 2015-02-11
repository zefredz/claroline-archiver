<?php

namespace Claroline\Module;

use Claroline\Core\ModuleInterface;

class Installer {

  protected $app;

  public function __construct( $app ) {

    $this->app = $app;
  }

  public function install( ModuleInterface $module ) {

    $schema = $this->app['db']->getSchemaManager()->createSchema();

    $platform = $this->app['db']->getDatabasePlatform();

    $schema = $module->schema( $schema );

    $createQueries = $schema->toSql($platform);

    foreach ( $createQueries as $query ) {
      $app['db']->executeQuery( $query );
    }
  }
}
