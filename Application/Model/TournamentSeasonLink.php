<?php

class TournamentSeasonLink extends HS_DatabaseObject {
	protected $tournamentID; // Int
	protected $seasonID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($objsArray) {
		return parent::fromDBHelper(new self(), array(
			"tournamentID" => $objsArray["tournament"]->id,
			"seasonID" => $objsArray["season"]->id));
	}

	public static function create($objsArray, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($objsArray)) {
			return null;
		}
		
		
		
		
		$dbObj->dbInsert((new MySQLBuilder())->
			insert("TournamentSeasonLink",
				array("tournamentID", "seasonID"),
				array($objsArray["tournament"]->id,
					$objsArray["season"]->id)));
		
		$dbObj = self::fromDB($objsArray);
		
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
			$whereArray["{$prefix}TournamentSeasonLink.tournamentID"] = $whereData["tournamentID"];
		}
		if (isset($whereData["seasonID"])) {
			$whereArray["{$prefix}TournamentSeasonLink.seasonID"] = $whereData["seasonID"];
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}TournamentSeasonLink_tournamentID_"));
		}
		if (isset($whereData["season"])) {
			$whereArray = array_merge($whereArray, Season::createWhereArray($whereData["season"], "{$prefix}TournamentSeasonLink_seasonID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TournamentSeasonLink.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return array("tournamentID", "seasonID");
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
		return array("tournamentID" => "Tournament", "seasonID" => "Season");
	}

	public static function getColumnNames() {
		return array("tournamentID", "seasonID");
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
	
	// @DoNotUpdate
	public function isEditableByUser() {
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		return true;
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
		
		if ($this->tournamentID == null || $this->seasonID == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		// Nothing to update
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->tournamentID == null || $this->seasonID == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("TournamentSeasonLink")->
			where(array("tournamentID" => $this->tournamentID, "seasonID" => $this->seasonID)));
		
		return "";
	}

	/* Getters */
	
	public function getTournament() {
		if ( ! property_exists($this, "tournament")) {
			$this->tournament = Tournament::childFromDB($this->tournamentID);
		}
		return $this->tournament;
	}

	public function getSeason() {
		if ( ! property_exists($this, "season")) {
			$this->season = Season::fromDB($this->seasonID);
		}
		return $this->season;
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
