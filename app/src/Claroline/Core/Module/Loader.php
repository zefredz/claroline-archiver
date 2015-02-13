<?php

namespace Claroline\Core\Module;

use Symfony\Component\Finder\Finder;
use Silex\Application;

class Loader {

  protected $loaded = array();

  public function load( Application $app ) {
    $finder = Finder::create()->files()->in($app['claroline.modules.path'])->name('*.php')->sortByName();

    foreach ( $finder as $file ) {
      $module = include_once $file->getRealpath();
      if ( call_user_func( $module, $app ) ) {
        $this->loaded[] = $file->getFilename();
        $app['monolog']->addDebug("Module {$file->getFilename()} loaded.");
      }
      else {
        $app['monolog']->addError("Failed to load module {$file->getFilename()}.");
      }
    }
  }
}
