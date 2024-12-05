<?php

class TournamentFormatLink extends HS_DatabaseObject {
	protected $tournamentID; // Int
	protected $formatID; // Int
	protected $data; // String

	/* Static 'Constructors' */
	
	public static function fromDB($objsArray) {
		return parent::fromDBHelper(new self(), array(
			"tournamentID" => $objsArray["tournament"]->id,
			"formatID" => $objsArray["format"]->id));
	}

	public static function create($objsArray, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($objsArray)) {
			return null;
		}
		
		
		if (isset($clientDataObj->tournament, $clientDataObj->tournament->id) && self::exists(array("tournamentID" => $clientDataObj->tournament->id))) {
			return "A Tournament Format Link already exists with that tournamentID - you cannot have duplicate entries.";
		}
		if (isset($clientDataObj->format, $clientDataObj->format->id) && self::exists(array("formatID" => $clientDataObj->format->id))) {
			return "A Tournament Format Link already exists with that formatID - you cannot have duplicate entries.";
		}
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("TournamentFormatLink",
				array("tournamentID", "formatID", "data"),
				array($objsArray["tournament"]->id,
					$objsArray["format"]->id,
					$objsArray["data"])));
		
		$dbObj = self::fromDB($objsArray);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
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
		
		if (isset($whereData["tournamentID"])) {
			$whereArray["{$prefix}TournamentFormatLink.tournamentID"] = $whereData["tournamentID"];
		}
		if (isset($whereData["formatID"])) {
			$whereArray["{$prefix}TournamentFormatLink.formatID"] = $whereData["formatID"];
		}
		if (isset($whereData["data"])) {
			$whereArray["{$prefix}TournamentFormatLink.data"] = $whereData["data"];
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}TournamentFormatLink_tournamentID_"));
		}
		if (isset($whereData["format"])) {
			$whereArray = array_merge($whereArray, TournamentFormat::createWhereArray($whereData["format"], "{$prefix}TournamentFormatLink_formatID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TournamentFormatLink.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return array("tournamentID", "formatID");
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
		return array("tournamentID" => "Tournament", "formatID" => "TournamentFormat");
	}

	public static function getColumnNames() {
		return array("tournamentID", "formatID", "data");
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
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to update this value.";
		}
		
		if ($this->tournamentID == null || $this->formatID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (property_exists($clientDataObj, "data")) {
				$this->data = $clientDataObj->data;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TournamentFormatLink",
				array("data"),
				array($this->data))->
			where(array("tournamentID" => $this->tournamentID, "formatID" => $this->formatID)));
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->tournamentID == null || $this->formatID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("TournamentFormatLink")->
			where(array("tournamentID" => $this->tournamentID, "formatID" => $this->formatID)));
		
		return "";
	}

	/* Getters */
	
	public function getTournament() {
		if ( ! property_exists($this, "tournament")) {
			$this->tournament = Tournament::childFromDB($this->tournamentID);
		}
		return $this->tournament;
	}

	public function getFormat() {
		if ( ! property_exists($this, "format")) {
			$this->format = TournamentFormat::fromDB($this->formatID);
		}
		return $this->format;
	}

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
