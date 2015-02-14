<?php

namespace Claroline\Module;

use Claroline\Core\ModuleInterface;

/**
 * Module installer
 * @package claroline-core
 */
class Installer {

  public function install( Application $app, ModuleInterface $module ) {

    $schema = $app['db']->getSchemaManager()->createSchema();

    $platform = $app['db']->getDatabasePlatform();

    $schema = $module->schema( $schema );

    $createQueries = $schema->toSql($platform);

    foreach ( $createQueries as $query ) {
      $app['db']->executeQuery( $query );
    }
  }
}
