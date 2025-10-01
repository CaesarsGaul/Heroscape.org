<?php

class TournamentIncludesFigureSetSubGroup extends HS_DatabaseObject {
	protected $id; // Int
	protected $tournamentID; // Int
	protected $figureSetSubGroupID; // Int
	protected $include; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TournamentIncludesFigureSetSubGroup"])) {
			$OBJECT_MAP["TournamentIncludesFigureSetSubGroup"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TournamentIncludesFigureSetSubGroup"][$id])) {
			$obj = $OBJECT_MAP["TournamentIncludesFigureSetSubGroup"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TournamentIncludesFigureSetSubGroup"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A Tournament Includes Figure Set Sub Group already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->figureSetSubGroup->id)) {
			$clientDataObj->figureSetSubGroup = FigureSetSubGroup::create($clientDataObj->figureSetSubGroup);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("TournamentIncludesFigureSetSubGroup",
				array("tournamentID", "figureSetSubGroupID", "include"),
				array($clientDataObj->tournament->id,
					$clientDataObj->figureSetSubGroup->id,
					isset($clientDataObj->include) && $clientDataObj-> include ? true : false)));
		
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
			$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.tournamentID"] = null;
				}
			}
			if (array_key_exists("figureSetSubGroup", $whereData)) {
				if (isset($whereData["figureSetSubGroup"]->id)) {
					$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.figureSetSubGroupID"] = $whereData["figureSetSubGroup"]->id;
				} else if ($whereData["figureSetSubGroup"] == null) {
					$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.figureSetSubGroupID"] = null;
				}
			}
			if (isset($whereData["include"])) {
				$whereArray["{$prefix}TournamentIncludesFigureSetSubGroup.include"] = $whereData["include"];
			}
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}TournamentIncludesFigureSetSubGroup_tournamentID_"));
		}
		if (isset($whereData["figureSetSubGroup"])) {
			$whereArray = array_merge($whereArray, FigureSetSubGroup::createWhereArray($whereData["figureSetSubGroup"], "{$prefix}TournamentIncludesFigureSetSubGroup_figureSetSubGroupID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("TournamentIncludesFigureSetSubGroup.name" => "ASC")
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
		return array("tournamentID" => "Tournament", "figureSetSubGroupID" => "FigureSetSubGroup");
	}

	public static function getColumnNames() {
		return array("id", "tournamentID", "figureSetSubGroupID", "include");
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
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		if ($clientDataObj != null) {
			if (isset($clientDataObj->tournament, $clientDataObj->tournament->id) &&
					$clientDataObj->tournament->id > 0) {
					$this->tournamentID = $clientDataObj->tournament->id;
			}
			if (isset($clientDataObj->figureSetSubGroup, $clientDataObj->figureSetSubGroup->id) &&
					$clientDataObj->figureSetSubGroup->id > 0) {
					$this->figureSetSubGroupID = $clientDataObj->figureSetSubGroup->id;
			}
			if (isset($clientDataObj->include)) {
				$this->include = $clientDataObj->include;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->tournament) && ( ! isset($clientDataObj->updateClasses) || (in_array("Tournament", $clientDataObj->updateClasses))) && in_array("tournament", $clientDataObj->fieldsToUpdate) && ! isset($this->tournamentIDJustCreated)) {
				(Tournament::childFromDB($this->tournamentID))->updateInDB($clientDataObj->tournament);
			}
			if (isset($clientDataObj->figureSetSubGroup) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSetSubGroup", $clientDataObj->updateClasses))) && in_array("figureSetSubGroup", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSetSubGroupIDJustCreated)) {
				(FigureSetSubGroup::fromDB($this->figureSetSubGroupID))->updateInDB($clientDataObj->figureSetSubGroup);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TournamentIncludesFigureSetSubGroup",
				array("tournamentID", "figureSetSubGroupID", "include"),
				array($this->tournamentID, $this->figureSetSubGroupID, $this->include))->
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
			delete("TournamentIncludesFigureSetSubGroup")->
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

	public function getFigureSetSubGroup() {
		if ( ! property_exists($this, "figureSetSubGroup")) {
			$this->figureSetSubGroup = FigureSetSubGroup::fromDB($this->figureSetSubGroupID);
		}
		return $this->figureSetSubGroup;
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
