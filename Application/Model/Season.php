<?php

class Season extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $leagueID; // Int
	protected $start; // Date
	protected $end; // Date
	protected $description; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Season"])) {
			$OBJECT_MAP["Season"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Season"][$id])) {
			$obj = $OBJECT_MAP["Season"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Season"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->league->id)) {
			$clientDataObj->league = League::create($clientDataObj->league);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Season",
				array("name", "leagueID", "start", "end", "description"),
				array($clientDataObj->name,
					$clientDataObj->league->id,
					$clientDataObj->start,
					$clientDataObj->end,
					$clientDataObj->description)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->tournaments)) {
			foreach ($clientDataObj->tournaments as $tempClientDataObj) {
				TournamentSeasonLink::create(array(
					"season" => $dbObj,
					"tournament" => Tournament::childFromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
	}

	/* Public Static Functions */
	
	// @DoNotUpdate
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
		
		if (isset($whereData["endAfter"])) {
			$whereArray["{$prefix}Season.end"] = array(
					"comparison" => ">=", 
					"value" => $whereData["endAfter"]);
		}
		if (isset($whereData["endBefore"])) {
			$whereArray["{$prefix}Season.end"] = array(
					"comparison" => "<", 
					"value" => $whereData["endBefore"]);
		}
		if (isset($whereData["startBefore"]) && isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Season.start"] = array(
				"comparison" => "<=",
				"value" => $whereData["startBefore"],
				"and" => array(
					"comparison" => ">=",
					"value" => $whereData["startAfter"]
				)
			);
		} else if (isset($whereData["startBefore"])) {
			$whereArray["{$prefix}Season.start"] = array(
					"comparison" => "<=", 
					"value" => $whereData["startBefore"]);
		} else if (isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Season.start"] = array(
					"comparison" => ">=", 
					"value" => $whereData["startAfter"]);
		} 
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}Season.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Season.name"] = $whereData["name"];
			}
			if (array_key_exists("league", $whereData)) {
				if (isset($whereData["league"]->id)) {
					$whereArray["{$prefix}Season.leagueID"] = $whereData["league"]->id;
				} else if ($whereData["league"] == null) {
					$whereArray["{$prefix}Season.leagueID"] = null;
				}
			}
			if (isset($whereData["start"])) {
				$whereArray["{$prefix}Season.start"] = $whereData["start"];
			}
			if (isset($whereData["end"])) {
				$whereArray["{$prefix}Season.end"] = $whereData["end"];
			}
			if (isset($whereData["description"])) {
				$whereArray["{$prefix}Season.description"] = $whereData["description"];
			}
		}
		
		if (isset($whereData["league"])) {
			$whereArray = array_merge($whereArray, League::createWhereArray($whereData["league"], "{$prefix}Season_leagueID_"));
		}
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["id"], "{$prefix}Season_id_TournamentSeasonLink_tournamentID_"));
		}
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("Season.name" => "ASC");
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("TournamentSeasonLink" => "seasonID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("TournamentSeasonLink" => "Tournament");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("TournamentSeasonLink" => "tournaments");
	}

	public static function getNTo1LinkClasses() {
		return array();
	}

	public static function getForeignKeys() {
		return array("leagueID" => "League");
	}

	public static function getColumnNames() {
		return array("id", "name", "leagueID", "start", "end", "description");
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
		return $this->getLeague()->isEditableByUser();
		/*if (isset($this->league) && $this->league != null) {
			return $this->league->isEditableByUser();
		}
		return false; */
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (isset($implicitObjects->league)) {
			$league = League::fromDB($implicitObjects->league->id);
			return $league->isEditableByUser();
		}
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
		TournamentSeasonLink::deleteEntries(TournamentSeasonLink::fetch(array("season" => $this)));
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
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->league, $clientDataObj->league->id) &&
					$clientDataObj->league->id > 0) {
					$this->leagueID = $clientDataObj->league->id;
			}
			if (isset($clientDataObj->start)) {
				$this->start = $clientDataObj->start;
			}
			if (isset($clientDataObj->end)) {
				$this->end = $clientDataObj->end;
			}
			if (property_exists($clientDataObj, "description")) {
				$this->description = $clientDataObj->description;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->league) && ( ! isset($clientDataObj->updateClasses) || (in_array("League", $clientDataObj->updateClasses))) && in_array("league", $clientDataObj->fieldsToUpdate) && ! isset($this->leagueIDJustCreated)) {
				(League::fromDB($this->leagueID))->updateInDB($clientDataObj->league);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Season",
				array("name", "leagueID", "start", "end", "description"),
				array($this->name, $this->leagueID, $this->start, $this->end, $this->description))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'TournamentSeasonLink.seasonID'}))) && in_array("tournaments", $clientDataObj->linksToUpdate)) {
			$links = TournamentSeasonLink::fetch(array("season" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getTournament();
			}
			$newObjs = array();
			foreach ($clientDataObj->tournaments as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = Tournament::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				TournamentSeasonLink::create(array("tournament" => $newObj, "season" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(TournamentSeasonLink::fromDB(array("tournament" => $oldObj, "season" => $this)))->deleteInDB();
			}
		}
		
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
			delete("Season")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getLeague() {
		if ( ! property_exists($this, "league")) {
			$this->league = League::fromDB($this->leagueID);
		}
		return $this->league;
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
