<?php

class BracketEntry extends HS_DatabaseObject {
	protected $id; // Int
	protected $bracketID; // Int
	protected $playerID; // Int
	protected $seed; // Int
	protected $eliminated; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["BracketEntry"])) {
			$OBJECT_MAP["BracketEntry"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["BracketEntry"][$id])) {
			$obj = $OBJECT_MAP["BracketEntry"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["BracketEntry"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->bracket->id)) {
			$clientDataObj->bracket = Bracket::create($clientDataObj->bracket);
		}
		if ( ! isset($clientDataObj->player->id)) {
			$clientDataObj->player = Player::create($clientDataObj->player);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("BracketEntry",
				array("bracketID", "playerID", "seed", "eliminated"),
				array($clientDataObj->bracket->id,
					$clientDataObj->player->id,
					$clientDataObj->seed,
					isset($clientDataObj->eliminated) && $clientDataObj-> eliminated ? true : false)));
		
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
			$whereArray["{$prefix}BracketEntry.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("bracket", $whereData)) {
				if (isset($whereData["bracket"]->id)) {
					$whereArray["{$prefix}BracketEntry.bracketID"] = $whereData["bracket"]->id;
				} else if ($whereData["bracket"] == null) {
					$whereArray["{$prefix}BracketEntry.bracketID"] = null;
				}
			}
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}BracketEntry.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}BracketEntry.playerID"] = null;
				}
			}
			if (isset($whereData["seed"])) {
				$whereArray["{$prefix}BracketEntry.seed"] = $whereData["seed"];
			}
			if (isset($whereData["eliminated"])) {
				$whereArray["{$prefix}BracketEntry.eliminated"] = $whereData["eliminated"];
			}
		}
		
		if (isset($whereData["bracket"])) {
			$whereArray = array_merge($whereArray, Bracket::createWhereArray($whereData["bracket"], "{$prefix}BracketEntry_bracketID_"));
		}
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, Player::createWhereArray($whereData["player"], "{$prefix}BracketEntry_playerID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("BracketEntry.name" => "ASC")
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
		return array("bracketID" => "Bracket", "playerID" => "Player");
	}

	public static function getColumnNames() {
		return array("id", "bracketID", "playerID", "seed", "eliminated");
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
			if (isset($clientDataObj->bracket, $clientDataObj->bracket->id) &&
					$clientDataObj->bracket->id > 0) {
					$this->bracketID = $clientDataObj->bracket->id;
			}
			if (isset($clientDataObj->player, $clientDataObj->player->id) &&
					$clientDataObj->player->id > 0) {
					$this->playerID = $clientDataObj->player->id;
			}
			if (isset($clientDataObj->seed)) {
				$this->seed = $clientDataObj->seed;
			}
			if (isset($clientDataObj->eliminated)) {
				$this->eliminated = $clientDataObj->eliminated;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->bracket) && ( ! isset($clientDataObj->updateClasses) || (in_array("Bracket", $clientDataObj->updateClasses))) && in_array("bracket", $clientDataObj->fieldsToUpdate) && ! isset($this->bracketIDJustCreated)) {
				(Bracket::fromDB($this->bracketID))->updateInDB($clientDataObj->bracket);
			}
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("Player", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(Player::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("BracketEntry",
				array("bracketID", "playerID", "seed", "eliminated"),
				array($this->bracketID, $this->playerID, $this->seed, $this->eliminated))->
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
			delete("BracketEntry")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getBracket() {
		if ( ! property_exists($this, "bracket")) {
			$this->bracket = Bracket::fromDB($this->bracketID);
		}
		return $this->bracket;
	}

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
