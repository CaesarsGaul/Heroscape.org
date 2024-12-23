<?php

class PlayerArmy extends HS_DatabaseObject {
	protected $id; // Int
	protected $army; // String
	protected $armyNumber; // Int
	protected $playerID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["PlayerArmy"])) {
			$OBJECT_MAP["PlayerArmy"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["PlayerArmy"][$id])) {
			$obj = $OBJECT_MAP["PlayerArmy"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["PlayerArmy"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->player->id)) {
			$clientDataObj->player = Player::create($clientDataObj->player);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("PlayerArmy",
				array("army", "armyNumber", "playerID"),
				array($clientDataObj->army,
					$clientDataObj->armyNumber,
					$clientDataObj->player->id)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->playerArmyCards)) {
			foreach ($clientDataObj->playerArmyCards as $clientLinkObj) {
				$clientLinkObj->playerArmy = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
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
			$whereArray["{$prefix}PlayerArmy.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["army"])) {
				$whereArray["{$prefix}PlayerArmy.army"] = $whereData["army"];
			}
			if (isset($whereData["armyNumber"])) {
				$whereArray["{$prefix}PlayerArmy.armyNumber"] = $whereData["armyNumber"];
			}
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}PlayerArmy.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}PlayerArmy.playerID"] = null;
				}
			}
		}
		
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, Player::createWhereArray($whereData["player"], "{$prefix}PlayerArmy_playerID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("PlayerArmy.armyNumber" => "ASC");
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
		return array("PlayerArmyCard" => "playerArmyID");
	}

	public static function getForeignKeys() {
		return array("playerID" => "Player");
	}

	public static function getColumnNames() {
		return array("id", "army", "armyNumber", "playerID");
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
		return $this->getPlayer()->isEditableByUser();
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		
		return true;
		
		// TODO - OLD BELOW THIS LINE
		
		$returnVal = false;
				
		$tournament = $this->getPlayer()->getTournament();
		/*if (isset($tournament->armiesViewable)) {
			return $tournament->armiesViewable;
		}*/
		
		if ($this->isEditableByUser()) {
			$returnVal = true;
		}
		
		if ($tournament->started) {
			return true;
			/*players = Player::fetch(array("tournament" => $tournament), 
				array("tournamentID" => array(), "PlayerArmy.playerID" => array()));
			$allArmiesSubmitted = true;
			foreach ($players as $player) {
				if (count($player->playerArmys) == 0) {
					$allArmiesSubmitted = false;
					break;
				}				
			}
			if ($allArmiesSubmitted) {
				$returnVal = true;
			}	*/		
		}
		//$returnVal = false;
		
		/*$tournament->armiesViewable = $returnVal;
		return $returnVal;*/
		return $returnVal;
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

	// @DoNotUpdate
	public function columnIsViewableByUser($columnName) {
		$user = LoginCredentials::getLoggedInUser();
		switch ($columnName) {
			case 'army':
				$tournament = $this->getPlayer()->getTournament();
				if ($this->isEditableByUser() || $tournament->started) {
					return true;
				}
				return false;
		}
		return $this->isViewableByUser();
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
		if (PlayerArmyCard::countEntries(array("PlayerArmyCard.playerArmyID" => $this->id)) > 0) {
			return "Unable to delete Player Army because one or more Player Army Card is dependent on it.";
		}
		
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
			if (isset($clientDataObj->army)) {
				$this->army = $clientDataObj->army;
			}
			if (isset($clientDataObj->armyNumber)) {
				$this->armyNumber = $clientDataObj->armyNumber;
			}
			if (isset($clientDataObj->player, $clientDataObj->player->id) &&
					$clientDataObj->player->id > 0) {
					$this->playerID = $clientDataObj->player->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("Player", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(Player::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("PlayerArmy",
				array("army", "armyNumber", "playerID"),
				array($this->army, $this->armyNumber, $this->playerID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->playerArmyCards) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->playerArmyCards as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = PlayerArmyCard::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->playerArmy = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
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
			delete("PlayerArmy")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getPlayer() {
		if ( ! property_exists($this, "player")) {
			$this->player = Player::fromDB($this->playerID);
		}
		return $this->player;
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
