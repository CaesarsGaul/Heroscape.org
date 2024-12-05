<?php

class GameTournament extends Tournament {
	protected $tournamentID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($tournamentID, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["GameTournament"])) {
			$OBJECT_MAP["GameTournament"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["GameTournament"][$tournamentID])) {
			$obj = $OBJECT_MAP["GameTournament"][$tournamentID];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("tournamentID" => $tournamentID), "Tournament", $tournamentID);
			$OBJECT_MAP["GameTournament"][$tournamentID] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		Tournament::createTournament($dbObj, $clientDataObj);
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("GameTournament",
				array("tournamentID"),
				array($dbObj->id)));
		
		$dbObj = self::fromDB($dbObj->id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		parent::createInitialLinks($clientDataObj);
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
		
		if (isset($whereData["tournamentID"])) {
			$whereArray["{$prefix}GameTournament.tournamentID"] = $whereData["tournamentID"];
		}
		else {
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}GameTournament_tournamentID_"));
		}
		
		
		return array_merge($whereArray, parent::createWhereArray($whereData, $prefix));
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("GameTournament.name" => "ASC")
		return array_merge(array(), parent::getOrderBy());
	}

	public static function getPrimaryKey() {
		return "tournamentID";
	}

	public static function getNToMLinkClasses() {
		return array_merge(array(), parent::getNToMLinkClasses());
	}

	public static function getNToMLinkClassesWithType() {
		return array_merge(array(), parent::getNToMLinkClassesWithType());
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array_merge(array(), parent::getNToMLinkClassesWithJSVariableName());
	}

	public static function getNTo1LinkClasses() {
		return array_merge(array(), parent::getNTo1LinkClasses());
	}

	public static function getForeignKeys() {
		return array_merge(array(), parent::getForeignKeys());
	}

	public static function getColumnNames() {
		return array_merge(array("tournamentID"), parent::getColumnNames());
	}

	public static function getActionNames() {
		return array_merge(array(), parent::getActionNames());
	}

	public function performAction($action) {
		switch ($action->name) {
			default:
				return parent::performAction($action);
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
		//$user = LoginCredentials::getLoggedInUser();
		return false; // TODO: temporary only
		// TODO: return $user->TODO();
	}

	public function isViewableByUser() {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
	}

	public static function userCanCreate($implicitObjects=null) {
		//$user = LoginCredentials::getLoggedInUser();
		return true; // TODO: temporary only
	}

	public function userCanPerformAction($actionName) {
		//$user = LoginCredentials::getLoggedInUser();
		switch ($actionName) {
			default:
				return parent::userCanPerformAction($actionName);
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
		return parent::deleteLinks();
	}

	/* Inherited DatabaseObject Functions */
	
	public function updateInDB($clientDataObj = null) {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->tournamentID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		// No Columns To Update
		
		return parent::updateInDB($clientDataObj);
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->tournamentID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("GameTournament")->
			where(array("tournamentID" => $this->tournamentID)));
		
		return parent::deleteInDB();
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
