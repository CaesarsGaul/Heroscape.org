<?php

class TournamentFormatTag extends HS_DatabaseObject {
	protected $id; // Int
	protected $tournamentID; // Int
	protected $formatID; // Int
	protected $data; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TournamentFormatTag"])) {
			$OBJECT_MAP["TournamentFormatTag"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TournamentFormatTag"][$id])) {
			$obj = $OBJECT_MAP["TournamentFormatTag"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TournamentFormatTag"][$id] = $obj;
		}
		return $obj;
	}

	// @DoNotUpdate
	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("TournamentFormatTag",
				array("tournamentID", "formatID", "data"),
				array($clientDataObj->tournament->id,
					$clientDataObj->format->id,
					$clientDataObj->data)));
		
		$dbObj = self::fromDB($id);
		
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
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}TournamentFormatTag.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}TournamentFormatTag.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}TournamentFormatTag.tournamentID"] = null;
				}
			}
			if (array_key_exists("format", $whereData)) {
				if (isset($whereData["format"]->id)) {
					$whereArray["{$prefix}TournamentFormatTag.formatID"] = $whereData["format"]->id;
				} else if ($whereData["format"] == null) {
					$whereArray["{$prefix}TournamentFormatTag.formatID"] = null;
				}
			}
			if (isset($whereData["data"])) {
				$whereArray["{$prefix}TournamentFormatTag.data"] = $whereData["data"];
			}
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}TournamentFormatTag_tournamentID_"));
		}
		if (isset($whereData["format"])) {
			$whereArray = array_merge($whereArray, TournamentFormat::createWhereArray($whereData["format"], "{$prefix}TournamentFormatTag_formatID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TournamentFormatTag.name" => "ASC")
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
		return array("tournamentID" => "Tournament", "formatID" => "TournamentFormat");
	}

	public static function getColumnNames() {
		return array("id", "tournamentID", "formatID", "data");
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
		return $this->getTournament()->isEditableByUser();
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
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
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (isset($clientDataObj->tournament, $clientDataObj->tournament->id) &&
					$clientDataObj->tournament->id > 0) {
					$this->tournamentID = $clientDataObj->tournament->id;
			}
			if (isset($clientDataObj->format, $clientDataObj->format->id) &&
					$clientDataObj->format->id > 0) {
					$this->formatID = $clientDataObj->format->id;
			}
			if (property_exists($clientDataObj, "data")) {
				$this->data = $clientDataObj->data;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->tournament) && ( ! isset($clientDataObj->updateClasses) || (in_array("Tournament", $clientDataObj->updateClasses))) && in_array("tournament", $clientDataObj->fieldsToUpdate) && ! isset($this->tournamentIDJustCreated)) {
				(Tournament::childFromDB($this->tournamentID))->updateInDB($clientDataObj->tournament);
			}
			if (isset($clientDataObj->format) && ( ! isset($clientDataObj->updateClasses) || (in_array("TournamentFormat", $clientDataObj->updateClasses))) && in_array("format", $clientDataObj->fieldsToUpdate) && ! isset($this->formatIDJustCreated)) {
				(TournamentFormat::fromDB($this->formatID))->updateInDB($clientDataObj->format);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TournamentFormatTag",
				array("tournamentID", "formatID", "data"),
				array($this->tournamentID, $this->formatID, $this->data))->
			where(array("id" => $this->id)));
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		$deleteLinksMsg = $this->deleteLinks();
		if (strlen($deleteLinksMsg) > 0) {
			return $deleteLinksMsg;
		}
		
		$this->dbDelete((new MySQLBuilder())->
			delete("TournamentFormatTag")->
			where(array("id" => $this->id)));
		
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
