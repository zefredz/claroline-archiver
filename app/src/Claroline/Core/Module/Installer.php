<?php

namespace Claroline\Module;

use Claroline\Core\ModuleInterface;
use Silex\Application;

/**
 * Module installer
 * @package claroline-core
 */
class Installer {

  /**
   * Install a module
   * @param  Silex\Application     $app
   * @param  Claroline\Core\ModuleInterface $module
   * @return void
   */
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
