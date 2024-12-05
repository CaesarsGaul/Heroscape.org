<?php

// Imports
require_once(Libraries . '/Internal/Database/PHP/DatabaseObject.php');
require_once(Libraries . '/Internal/Database/PHP/MySQLBuilder.php');
require_once(Model . '/HS_DatabaseConnection.php');

require_once(Libraries . '/Internal/Email/PHP/Email.php');

/* See DatabaseObject.php for instructions on how to sub-class this class
*/
abstract class HS_DatabaseObject extends DatabaseObject {
	
	/* Default Constructor */
	protected function __construct () {
		// Call super constructor
		parent::__construct(HS_DatabaseConnection::instance());
	}
	
}

?>