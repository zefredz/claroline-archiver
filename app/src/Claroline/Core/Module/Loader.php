<?php

namespace Claroline\Core\Module;

use Symfony\Component\Finder\Finder;
use Silex\Application;

/**
 *
 */
class Loader {

  protected $loaded = array();

  /**
   * Load available modules
   * @param  Silex\Application $app [description]
   * @return void
   */
  public function load( Application $app ) {

    $finder = Finder::create()->files()->in($app['claroline.modules.path'])->name('*.php')->sortByName();

    foreach ( $finder as $file ) {
      $module = include_once $file->getRealpath();
      if ( $moduleName = call_user_func( $module, $app ) ) {
        $this->loaded[] = $moduleName;
        $app['monolog']->addDebug("Module {$moduleName} loaded.");
      }
      else {
        $app['monolog']->addError("Failed to load module from {$file->getFilename()}.");
      }
    }
  }

  /**
   * Get list of loaded module names
   * @return array of loaded modules names
   */
  public function getLoadedModuleList() {
    return $this->loaded;
  }
}
