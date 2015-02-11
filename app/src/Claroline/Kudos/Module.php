<?php

namespace Claroline\Kudos;

use Claroline\Module\ModuleInterface;

class Module implements ModuleInterface {

  const LABEL = 'claroline-kudos';

  public function depend() {
    return array();
  }

  public function install() {

  }

  public function uninstall() {

  }

  public function enable() {

  }

  public function disable() {

  }

  public function schema( $schema ) {

    // table to store the users
    $usersTable = $schema->createTable("user");

    $usersTable->addColumn("id", "integer", array("unsigned" => true,"autoincrement" => true));
    $usersTable->addColumn("name", "string", array("length" => 255));

    $usersTable->setPrimaryKey(array("id"));

    // table to store the kudos
    $kudosTable = $schema->createTable("kudos");

    $kudosTable->addColumn("uid", "integer", array("unsigned" => true,"autoincrement" => true));
    $kudosTable->addColumn("kudos", "integer");

    $kudosTable->setPrimaryKey(array("uid"));

    $kudosTable->addForeignKeyConstraint(
  		$usersTable,
	    array("uid"),
	    array("id"),
	    array("onDelete" => "CASCADE")
  	);

    return $schema;
  }

  public function label() {
    return self::LABEL;
  }
}
