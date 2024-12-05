<?php

// Imports
require_once(Libraries . '/Internal/Database/PHP/DatabaseConnection.php');

/* 
Database Connection for Poker Clock
To use, call:
	PC_DatabaseConnection::instance()
*/
class HS_DatabaseConnection extends DatabaseConnection {
	
	/* Default Constructor */
	public function __construct () {
		parent::__construct(AboveWebRoot . "secureFiles/dbms/config.ini");
	}

	/* Default Destructor */
	public function __destruct() {
		parent::__destruct();
	}
	
	/* Creates Singleton Instance */
	public static function instance() {
        if (self::$instance === null || get_class(self::$instance) != "HS_DatabaseConnection") {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

?>