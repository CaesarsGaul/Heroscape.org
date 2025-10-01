<?php

class UnitWinRateDeltaView extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $W; // Int
	protected $L; // Int
	protected $WinPercent; // Decimal

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["UnitWinRateDeltaView"])) {
			$OBJECT_MAP["UnitWinRateDeltaView"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["UnitWinRateDeltaView"][$id])) {
			$obj = $OBJECT_MAP["UnitWinRateDeltaView"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["UnitWinRateDeltaView"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		// Class represents a view - do nothing here
	}

	protected function createInitialLinks($clientDataObj) {
	}

	/* Public Static Functions */
	
	public static function createWhereArray($whereData, $prefix="") {
		if (is_object($whereData)) {
			if (is_a($whereData, "DatabaseObject")) {
				$whereData = $whereData->toArray();
			} else {
				$whereData = (array)$whereData;
			}
		} else if ($whereData == null) {
			$whereData = array();
		}
		$whereArray = array();
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}UnitWinRateDeltaView.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}UnitWinRateDeltaView.name"] = $whereData["name"];
			}
			if (isset($whereData["W"])) {
				$whereArray["{$prefix}UnitWinRateDeltaView.W"] = $whereData["W"];
			}
			if (isset($whereData["L"])) {
				$whereArray["{$prefix}UnitWinRateDeltaView.L"] = $whereData["L"];
			}
			if (isset($whereData["WinPercent"])) {
				$whereArray["{$prefix}UnitWinRateDeltaView.WinPercent"] = $whereData["WinPercent"];
			}
		}
		
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("UnitWinRateDeltaView.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array();
	}

	public static function getNToMLinkClassesWithType() {
		return array();
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array();
	}

	public static function getNTo1LinkClasses() {
		return array();
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "W", "L", "WinPercent");
	}

	public static function getActionNames() {
		return array();
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return ""; // Do nothing
		}
	}

	public function linkedTo($obj) {
		/*if ($obj instanceof ClassName) {
			// TODO
		}*/
		return false;
	}

	/* Public Dynamic Functions */
	
	public function isEditableByUser() {
		return false;
	}

	public function isViewableByUser() {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
	}

	public static function userCanCreate($implicitObjects=null) {
		return false;
	}

	public function userCanPerformAction($actionName) {
		//$user = LoginCredentials::getLoggedInUser();
		switch ($actionName) {
			default:
				// Do nothing
		}
		return true; // TODO: temporary only
	}

	public function columnIsViewableByUser($columnName) {
		// Default Behavior
		return $this->isViewableByUser();
		// $user = LoginCredentials::getLoggedInUser();
		/*switch ($columnName) {
			case 'columnName':
				break;
		}*/
	}

	public function columnIsEditableByUser($columnName) {
		// Default Behavior
		return $this->isEditableByUser();
		// $user = LoginCredentials::getLoggedInUser();
		/*switch ($columnName) {
			case 'columnName':
				break;
		}*/
	}

	protected function deleteLinks() {
		// N-1 Links
		
		// N-M Links
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		// Class represents a view - do nothing here
	}

	public function deleteInDB() {
		// Class represents a view - do nothing here
	}

	/* Getters */
	
	/* 'Constructor' only for DB Connection */
	protected static function dbConnection($subdomain = null) {
		return new self($subdomain);
	}

	/* Use "fromDB()" to initialize, not this constructor */
	protected function __construct($subdomain = null) {
		parent::__construct($subdomain);
	}

}


?>
