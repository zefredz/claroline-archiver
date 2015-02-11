<?php

namespace Claroline\Module;

interface ModuleInterface {

  /**
   * Get module dependencies
   * @return array of MODULENAME => VERSION
   */
  public function depend();

  /**
   * [install description]
   * @return [type] [description]
   */
  public function install();

  /**
   * [uninstall description]
   * @return [type] [description]
   */
  public function uninstall();

  /**
   * [enable description]
   * @return [type] [description]
   */
  public function enable();

  /**
   * [disable description]
   * @return [type] [description]
   */
  public function disable();

  /**
   * Populate the schema with the tables of the module
   * @param Doctrine\DBAL\Schema\Schema $schema
   * @return Doctrine\DBAL\Schema\Schema database schema for the module
   */
  public function schema( $schema );

  /**
   * Get the label of the module.
   * The label is the alphanumeric machine name of the module.
   * @return string label of the module
   */
  public function label();

  public function permissions();

  public function contentTypes();
}
