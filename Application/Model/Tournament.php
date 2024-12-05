<?php

abstract class Tournament extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $description; // String
	protected $conventionID; // Int
	protected $startTime; // Datetime
	protected $endDate; // Date
	protected $address; // String
	protected $started; // Boolean
	protected $finished; // Boolean
	protected $allowSignupAfter; // Datetime
	protected $allowArmySubmissionAfter; // Datetime
	protected $allowLateSignup; // Boolean
	protected $online; // Boolean
	protected $maxEntries; // Int
	protected $teamSize; // Int
	protected $maxNumPlayersPerGame; // Int
	protected $numLossesToBeEliminated; // Int
	protected $pairAfterEliminated; // Boolean
	protected $roundLengthMinutes; // Int
	protected $bracketID; // Int
	protected $ignoreInStandings; // Boolean
	protected $figureSetID; // Int
	protected $sheetId; // String

	public static function TournamentFromDB($childObj, $id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Tournament"])) {
			$OBJECT_MAP["Tournament"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Tournament"][$id])) {
			$obj = $OBJECT_MAP["Tournament"][$id];
		} else {
			$obj = parent::fromDBHelper($childObj, array("id" => $id));
			$OBJECT_MAP["Tournament"][$id] = $obj;
		}
		return $obj;
	}

	public static function childFromDB($id) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Tournament"])) {
			$OBJECT_MAP["Tournament"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Tournament"][$id])) {
			$obj = $OBJECT_MAP["Tournament"][$id];
		} else {
			if (HeroscapeTournament::exists(array("tournamentID" => $id))) {
				$obj = HeroscapeTournament::fromDB($id);
			}
			if (GameTournament::exists(array("tournamentID" => $id))) {
				$obj = GameTournament::fromDB($id);
			}
			$OBJECT_MAP["Tournament"][$id] = $obj;
		}
		return $obj;
	}

	// @DoNotUpdate
	protected static function createTournament($dbObj, $clientDataObj) {
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		if (isset($clientDataObj->convention)) {
			$user = LoginCredentials::getLoggedInUser();
			$convention = Convention::fromDB($clientDataObj->convention->id);
			if (count(Admin::fetch(array("convention" => $convention, "user" => $user))) == 0) {
				return null;
			}
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Tournament",
				array("name", "description", "conventionID", "startTime", "endDate", "address",
					"allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", "maxEntries", 
					"teamSize", "maxNumPlayersPerGame", "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes",
					"sheetId", "figureSetID"),
				array($clientDataObj->name,
					$clientDataObj->description,
					isset($clientDataObj->convention) 
						? $clientDataObj->convention->id
						: null,
					$clientDataObj->startTime,
					$clientDataObj->endDate,
					$clientDataObj->address,
					$clientDataObj->allowSignupAfter,
					$clientDataObj->allowArmySubmissionAfter,
					$clientDataObj->allowLateSignup,
					$clientDataObj->online,
					$clientDataObj->maxEntries,
					$clientDataObj->teamSize,
					$clientDataObj->maxNumPlayersPerGame,
					$clientDataObj->numLossesToBeEliminated,
					$clientDataObj->pairAfterEliminated,
					$clientDataObj->roundLengthMinutes,
					$clientDataObj->sheetId,
					$clientDataObj->figureSet->id)));
		
		$dbObj->id = $id;
		
		if (isset($clientDataObj->seasons)) {
			foreach ($clientDataObj->seasons as $tempClientDataObj) {
				TournamentSeasonLink::create(array(
					"tournament" => $dbObj,
					"season" => Season::fromDB($tempClientDataObj->id)));
			}
		}
		
		$adminObj = new stdClass();
		$adminObj->user = LoginCredentials::getLoggedInUser();
		$adminObj->tournament = $dbObj;
		Admin::create($adminObj);
		
		// Abstract, no need to return
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->admins)) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				$clientLinkObj->tournament = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->players)) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				$clientLinkObj->tournament = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->rounds)) {
			foreach ($clientDataObj->rounds as $clientLinkObj) {
				$clientLinkObj->tournament = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->gameMaps)) {
			foreach ($clientDataObj->gameMaps as $clientLinkObj) {
				$clientLinkObj->tournament = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->tournamentFormatTags)) {
			foreach ($clientDataObj->tournamentFormatTags as $clientLinkObj) {
				$clientLinkObj->tournament = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
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
		} else if ( ! is_array($whereData)) {
			$whereData = array();
		}
		$whereArray = array();
		
		if (isset($whereData["endAfter"])) {
			$whereArray["{$prefix}Tournament.endDate"] = array(
					"comparison" => ">=", 
					"value" => $whereData["endAfter"]);
		}
		if (isset($whereData["endBefore"])) {
			$whereArray["{$prefix}Tournament.endDate"] = array(
					"comparison" => "<", 
					"value" => $whereData["endBefore"]);
		}
		if (isset($whereData["startBefore"]) && isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Tournament.startTime"] = array(
				"comparison" => "<=",
				"value" => $whereData["startBefore"],
				"and" => array(
					"comparison" => ">=",
					"value" => $whereData["startAfter"]
				)
			);
		} else if (isset($whereData["startBefore"])) {
			$whereArray["{$prefix}Tournament.startTime"] = array(
					"comparison" => "<=", 
					"value" => $whereData["startBefore"]);
		} else if (isset($whereData["startAfter"])) {
			$whereArray["{$prefix}Tournament.startTime"] = array(
					"comparison" => ">=", 
					"value" => $whereData["startAfter"]);
		} 
		
		if (isset($whereData["id"])) {
			$whereArray["{$prefix}Tournament.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Tournament.name"] = $whereData["name"];
			}
			if (isset($whereData["description"])) {
				$whereArray["{$prefix}Tournament.description"] = $whereData["description"];
			}
			if (array_key_exists("convention", $whereData)) {
				if (isset($whereData["convention"]->id)) {
					$whereArray["{$prefix}Tournament.conventionID"] = $whereData["convention"]->id;
				} else if ($whereData["convention"] == null) {
					$whereArray["{$prefix}Tournament.conventionID"] = null;
				}
			}
			if (isset($whereData["startTime"])) {
				$whereArray["{$prefix}Tournament.startTime"] = $whereData["startTime"];
			}
			if (isset($whereData["endDate"])) {
				$whereArray["{$prefix}Tournament.endDate"] = $whereData["endDate"];
			}
			if (isset($whereData["maxEntries"])) {
				$whereArray["{$prefix}Tournament.maxEntries"] = $whereData["maxEntries"];
			}
		}
		
		if (isset($whereData["convention"])) {
			$whereArray = array_merge($whereArray, Convention::createWhereArray($whereData["convention"], "{$prefix}Tournament_conventionID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("Tournament.startTime" => "ASC");
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("TournamentSeasonLink" => "tournamentID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("TournamentSeasonLink" => "Season");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("TournamentSeasonLink" => "seasons");
	}

	public static function getNTo1LinkClasses() {
		return array("Admin" => "tournamentID", "Player" => "tournamentID", "Round" => "tournamentID", "GameMap" => "tournamentID", "TournamentFormatTag" => "tournamentID");
	}

	public static function getForeignKeys() {
		return array("conventionID" => "Convention", "bracketID" => "Bracket", "figureSetID" => "FigureSet");
	}

	public static function getChildClasses() {
		return array("HeroscapeTournament", "GameTournament");
	}

	public static function getColumnNames() {
		return array("id", "name", "description", "conventionID", "startTime", "endDate", "address", "started", "finished", "allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", "maxEntries", "teamSize", "maxNumPlayersPerGame", "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes", "bracketID", "ignoreInStandings", "figureSetID", "sheetId");
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
		if ( ! isset($this->editableByUser)) {
			$this->editableByUser = false;
			if (LoginCredentials::userLoggedIn()) {
				$user = LoginCredentials::getLoggedInUser();
				$this->editableByUser = Admin::exists(array(
					"userID" => $user->id, 
					"tournamentID" => $this->id));
				if ( ! $this->editableByUser && $this->conventionID != null) {
					$this->editableByUser = 
						count(Admin::fetch(array(
							"convention" => $this->getConvention(), 
							"user" => $user))) > 0;
				}
				if ( ! $this->editableByUser) {
					$seasonLinks = TournamentSeasonLink::fetch(array("tournament" => $this));
					foreach ($seasonLinks as $seasonLink) {
						$season = $seasonLink->getSeason();
						if ($season->isEditableByUser()) {
							$this->editableByUser = true;
							break;
						}
					}
				}
			} 
		}
		return $this->editableByUser;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		return true;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			return $user->isVerified();
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

	// @DoNotUpdate
	public function columnIsViewableByUser($columnName) {
		switch ($columnName) {
			case 'sheetId':
				return false;
		}
		return $this->isViewableByUser();
	}

	// @DoNotUpdate
	public function columnIsEditableByUser($columnName) {
		switch ($columnName) {
			case 'sheetId':
				return false;
		}
		return $this->isEditableByUser();
	}

	protected function deleteLinks() {
		// N-1 Links
		if (Admin::countEntries(array("Admin.tournamentID" => $this->id)) > 0) {
			return "Unable to delete Tournament because one or more Admin is dependent on it.";
		}
		if (Player::countEntries(array("Player.tournamentID" => $this->id)) > 0) {
			return "Unable to delete Tournament because one or more Player is dependent on it.";
		}
		if (Round::countEntries(array("Round.tournamentID" => $this->id)) > 0) {
			return "Unable to delete Tournament because one or more Round is dependent on it.";
		}
		if (GameMap::countEntries(array("GameMap.tournamentID" => $this->id)) > 0) {
			return "Unable to delete Tournament because one or more Game Map is dependent on it.";
		}
		if (TournamentFormatTag::countEntries(array("TournamentFormatTag.tournamentID" => $this->id)) > 0) {
			return "Unable to delete Tournament because one or more Tournament Format Tag is dependent on it.";
		}
		
		// N-M Links
		TournamentSeasonLink::deleteEntries(TournamentSeasonLink::fetch(array("tournament" => $this)));
		return "";
	}

	/* Inherited DatabaseObject Functions */
	
	// @DoNotUpdate
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
			if (property_exists($clientDataObj, "description")) {
				$this->description = $clientDataObj->description;
			}
			/*if (property_exists($clientDataObj, "convention")) {
				if (isset($clientDataObj->convention)) {
					if (isset($clientDataObj->convention->id) && $clientDataObj->convention->id > 0) {
						$this->conventionID = $clientDataObj->convention->id;
					} else {
						$this->conventionID = (Convention::create($clientDataObj->convention))->id;
						$this->conventionIDJustCreated = true;
					}
				} else {
					$this->conventionID = null;
				}
			}*/
			if (isset($clientDataObj->startTime)) {
				$this->startTime = $clientDataObj->startTime;
			}
			if (isset($clientDataObj->endDate)) {
				$this->endDate = $clientDataObj->endDate;
			}
			if (isset($clientDataObj->address)) {
				$this->address = $clientDataObj->address;
			}
			if (property_exists($clientDataObj, "allowSignupAfter")) {
				$this->allowSignupAfter = $clientDataObj->allowSignupAfter;
			}
			if (property_exists($clientDataObj, "allowArmySubmissionAfter")) {
				$this->allowArmySubmissionAfter = $clientDataObj->allowArmySubmissionAfter;
			}
			if (isset($clientDataObj->allowLateSignup)) {
				$this->allowLateSignup = $clientDataObj->allowLateSignup;
			}
			if (property_exists($clientDataObj, "maxEntries")) {
				$this->maxEntries = $clientDataObj->maxEntries;
			}
			/*if (isset($clientDataObj->teamSize)) {
				$this->teamSize = $clientDataObj->teamSize;
			}*/
			/*if (isset($clientDataObj->maxNumPlayersPerGame)) {
				$this->maxNumPlayersPerGame = $clientDataObj->maxNumPlayersPerGame;
			}*/
			if (property_exists($clientDataObj, "numLossesToBeEliminated")) {
				$this->numLossesToBeEliminated = $clientDataObj->numLossesToBeEliminated;
			}
			if (isset($clientDataObj->pairAfterEliminated)) {
				$this->pairAfterEliminated = $clientDataObj->pairAfterEliminated;
			}
			if (property_exists($clientDataObj, "roundLengthMinutes")) {
				$this->roundLengthMinutes = $clientDataObj->roundLengthMinutes;
			}
			/*if (property_exists($clientDataObj, "bracket")) {
				if (isset($clientDataObj->bracket)) {
					if (isset($clientDataObj->bracket->id) && $clientDataObj->bracket->id > 0) {
						$this->bracketID = $clientDataObj->bracket->id;
					} else {
						$this->bracketID = (Bracket::create($clientDataObj->bracket))->id;
						$this->bracketIDJustCreated = true;
					}
				} else {
					$this->bracketID = null;
				}
			}*/
			/*if (property_exists($clientDataObj, "sheetId")) {
				$this->sheetId = $clientDataObj->sheetId;
			}*/
		}
		
		// Update Foreign Key Columns
		/*if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->convention) && ( ! isset($clientDataObj->updateClasses) || (in_array("Convention", $clientDataObj->updateClasses))) && in_array("convention", $clientDataObj->fieldsToUpdate) && ! isset($this->conventionIDJustCreated)) {
				(Convention::fromDB($this->conventionID))->updateInDB($clientDataObj->convention);
			}
			if (isset($clientDataObj->bracket) && ( ! isset($clientDataObj->updateClasses) || (in_array("Bracket", $clientDataObj->updateClasses))) && in_array("bracket", $clientDataObj->fieldsToUpdate) && ! isset($this->bracketIDJustCreated)) {
				(Bracket::fromDB($this->bracketID))->updateInDB($clientDataObj->bracket);
			}
		}*/
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Tournament",
				array("name", "description", /*"conventionID",*/ "startTime", "endDate", "allowSignupAfter", "allowArmySubmissionAfter", "allowLateSignup", "online", "maxEntries", /*"teamSize", "maxNumPlayersPerGame",*/ "numLossesToBeEliminated", "pairAfterEliminated", "roundLengthMinutes"/*, "bracketID", "sheetId"*/),
				array($this->name, $this->description, /*$this->conventionID,*/ $this->startTime, $this->endDate, $this->allowSignupAfter, $this->allowArmySubmissionAfter, $this->allowLateSignup, $this->online, $this->maxEntries, /*$this->teamSize, $this->maxNumPlayersPerGame,*/ $this->numLossesToBeEliminated, $this->pairAfterEliminated, $this->roundLengthMinutes/*, $this->bracketID, $this->sheetId*/))->
			where(array("id" => $this->id)));
		
		/*if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'TournamentSeasonLink.tournamentID'}))) && in_array("seasons", $clientDataObj->linksToUpdate)) {
			$links = TournamentSeasonLink::fetch(array("tournament" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getSeason();
			}
			$newObjs = array();
			foreach ($clientDataObj->seasons as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = Season::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				TournamentSeasonLink::create(array("season" => $newObj, "tournament" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(TournamentSeasonLink::fromDB(array("season" => $oldObj, "tournament" => $this)))->deleteInDB();
			}
		}*/
		
		// Update 1-N Links
		if (isset($clientDataObj->tournamentFormatTags) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->tournamentFormatTags as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = TournamentFormatTag::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->tournament = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		/*if (isset($clientDataObj->admins) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->admins as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Admin::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->tournament = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->players) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->players as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Player::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->tournament = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->rounds) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->rounds as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Round::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->tournament = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->gameMaps) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->gameMaps as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = GameMap::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->tournament = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}*/
		
		
		return "";
	}

	public function deleteInDB() {
		if ( ! $this->isEditableByUser()) {
			return "You do not have permission to delete this value.";
		}
		
		if ($this->id == null) {
			return "Unknown Error";
		}
		
		
		$this->dbDelete((new MySQLBuilder())->
			delete("Tournament")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getConvention() {
		if ($this->conventionID != null) {
			if ( ! property_exists($this, "convention")) {
				$this->convention = Convention::fromDB($this->conventionID);
			}
			return $this->convention;
		}
		return null;
	}

	public function getBracket() {
		if ($this->bracketID != null) {
			if ( ! property_exists($this, "bracket")) {
				$this->bracket = Bracket::fromDB($this->bracketID);
			}
			return $this->bracket;
		}
		return null;
	}

	public function getFigureSet() {
		if ( ! property_exists($this, "figureSet")) {
			$this->figureSet = FigureSet::fromDB($this->figureSetID);
		}
		return $this->figureSet;
	}

	/* 'Constructor' only for DB Connection */
	protected static function dbConnection($subdomain = null) {
		return HeroscapeTournament::dbConnection($subdomain);
	}

	/* Use "fromDB()" to initialize, not this constructor */
	protected function __construct($subdomain = null) {
		parent::__construct($subdomain);
	}

}


?>
