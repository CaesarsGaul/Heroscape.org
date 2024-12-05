<?php

class OnlineGameAttack extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameStateID; // Int
	protected $attackingFigureID; // Int
	protected $defendingFigureID; // Int
	protected $attackRollID; // Int
	protected $defenseRollID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGameAttack"])) {
			$OBJECT_MAP["OnlineGameAttack"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGameAttack"][$id])) {
			$obj = $OBJECT_MAP["OnlineGameAttack"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGameAttack"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->gameState->id)) {
			$clientDataObj->gameState = OnlineGameState::create($clientDataObj->gameState);
		}
		if ( ! isset($clientDataObj->attackingFigure->id)) {
			$clientDataObj->attackingFigure = OnlineGamePlayerFigure::create($clientDataObj->attackingFigure);
		}
		if ( ! isset($clientDataObj->defendingFigure->id)) {
			$clientDataObj->defendingFigure = OnlineGamePlayerFigure::create($clientDataObj->defendingFigure);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGameAttack",
				array("gameStateID", "attackingFigureID", "defendingFigureID", "attackRollID", "defenseRollID"),
				array($clientDataObj->gameState->id,
					$clientDataObj->attackingFigure->id,
					$clientDataObj->defendingFigure->id,
					$clientDataObj->attackRoll->id,
					isset($clientDataObj->defenseRoll) 
						? $clientDataObj->defenseRoll->id
						: null)));
		
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
			$whereArray["{$prefix}OnlineGameAttack.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("gameState", $whereData)) {
				if (isset($whereData["gameState"]->id)) {
					$whereArray["{$prefix}OnlineGameAttack.gameStateID"] = $whereData["gameState"]->id;
				} else if ($whereData["gameState"] == null) {
					$whereArray["{$prefix}OnlineGameAttack.gameStateID"] = null;
				}
			}
			if (array_key_exists("attackingFigure", $whereData)) {
				if (isset($whereData["attackingFigure"]->id)) {
					$whereArray["{$prefix}OnlineGameAttack.attackingFigureID"] = $whereData["attackingFigure"]->id;
				} else if ($whereData["attackingFigure"] == null) {
					$whereArray["{$prefix}OnlineGameAttack.attackingFigureID"] = null;
				}
			}
			if (array_key_exists("defendingFigure", $whereData)) {
				if (isset($whereData["defendingFigure"]->id)) {
					$whereArray["{$prefix}OnlineGameAttack.defendingFigureID"] = $whereData["defendingFigure"]->id;
				} else if ($whereData["defendingFigure"] == null) {
					$whereArray["{$prefix}OnlineGameAttack.defendingFigureID"] = null;
				}
			}
			if (array_key_exists("attackRoll", $whereData)) {
				if (isset($whereData["attackRoll"]->id)) {
					$whereArray["{$prefix}OnlineGameAttack.attackRollID"] = $whereData["attackRoll"]->id;
				} else if ($whereData["attackRoll"] == null) {
					$whereArray["{$prefix}OnlineGameAttack.attackRollID"] = null;
				}
			}
			if (array_key_exists("defenseRoll", $whereData)) {
				if (isset($whereData["defenseRoll"]->id)) {
					$whereArray["{$prefix}OnlineGameAttack.defenseRollID"] = $whereData["defenseRoll"]->id;
				} else if ($whereData["defenseRoll"] == null) {
					$whereArray["{$prefix}OnlineGameAttack.defenseRollID"] = null;
				}
			}
		}
		
		if (isset($whereData["gameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["gameState"], "{$prefix}OnlineGameAttack_gameStateID_"));
		}
		if (isset($whereData["attackingFigure"])) {
			$whereArray = array_merge($whereArray, OnlineGamePlayerFigure::createWhereArray($whereData["attackingFigure"], "{$prefix}OnlineGameAttack_attackingFigureID_"));
		}
		if (isset($whereData["defendingFigure"])) {
			$whereArray = array_merge($whereArray, OnlineGamePlayerFigure::createWhereArray($whereData["defendingFigure"], "{$prefix}OnlineGameAttack_defendingFigureID_"));
		}
		if (isset($whereData["attackRoll"])) {
			$whereArray = array_merge($whereArray, DiceRoll::createWhereArray($whereData["attackRoll"], "{$prefix}OnlineGameAttack_attackRollID_"));
		}
		if (isset($whereData["defenseRoll"])) {
			$whereArray = array_merge($whereArray, DiceRoll::createWhereArray($whereData["defenseRoll"], "{$prefix}OnlineGameAttack_defenseRollID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGameAttack.name" => "ASC")
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
		return array("gameStateID" => "OnlineGameState", "attackingFigureID" => "OnlineGamePlayerFigure", "defendingFigureID" => "OnlineGamePlayerFigure", "attackRollID" => "DiceRoll", "defenseRollID" => "DiceRoll");
	}

	public static function getColumnNames() {
		return array("id", "gameStateID", "attackingFigureID", "defendingFigureID", "attackRollID", "defenseRollID");
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
			if (isset($clientDataObj->gameState, $clientDataObj->gameState->id) &&
					$clientDataObj->gameState->id > 0) {
					$this->gameStateID = $clientDataObj->gameState->id;
			}
			if (isset($clientDataObj->attackingFigure, $clientDataObj->attackingFigure->id) &&
					$clientDataObj->attackingFigure->id > 0) {
					$this->attackingFigureID = $clientDataObj->attackingFigure->id;
			}
			if (isset($clientDataObj->defendingFigure, $clientDataObj->defendingFigure->id) &&
					$clientDataObj->defendingFigure->id > 0) {
					$this->defendingFigureID = $clientDataObj->defendingFigure->id;
			}
			if (isset($clientDataObj->attackRoll, $clientDataObj->attackRoll->id) &&
					$clientDataObj->attackRoll->id > 0) {
					$this->attackRollID = $clientDataObj->attackRoll->id;
			}
			if (property_exists($clientDataObj, "defenseRoll")) {
				if (isset($clientDataObj->defenseRoll)) {
					if (isset($clientDataObj->defenseRoll->id) && $clientDataObj->defenseRoll->id > 0) {
						$this->defenseRollID = $clientDataObj->defenseRoll->id;
					} else {
						$this->defenseRollID = (DiceRoll::create($clientDataObj->defenseRoll))->id;
						$this->defenseRollIDJustCreated = true;
					}
				} else {
					$this->defenseRollID = null;
				}
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->gameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("gameState", $clientDataObj->fieldsToUpdate) && ! isset($this->gameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->gameStateID))->updateInDB($clientDataObj->gameState);
			}
			if (isset($clientDataObj->attackingFigure) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGamePlayerFigure", $clientDataObj->updateClasses))) && in_array("attackingFigure", $clientDataObj->fieldsToUpdate) && ! isset($this->attackingFigureIDJustCreated)) {
				(OnlineGamePlayerFigure::fromDB($this->attackingFigureID))->updateInDB($clientDataObj->attackingFigure);
			}
			if (isset($clientDataObj->defendingFigure) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGamePlayerFigure", $clientDataObj->updateClasses))) && in_array("defendingFigure", $clientDataObj->fieldsToUpdate) && ! isset($this->defendingFigureIDJustCreated)) {
				(OnlineGamePlayerFigure::fromDB($this->defendingFigureID))->updateInDB($clientDataObj->defendingFigure);
			}
			if (isset($clientDataObj->attackRoll) && ( ! isset($clientDataObj->updateClasses) || (in_array("DiceRoll", $clientDataObj->updateClasses))) && in_array("attackRoll", $clientDataObj->fieldsToUpdate) && ! isset($this->attackRollIDJustCreated)) {
				(DiceRoll::childFromDB($this->attackRollID))->updateInDB($clientDataObj->attackRoll);
			}
			if (isset($clientDataObj->defenseRoll) && ( ! isset($clientDataObj->updateClasses) || (in_array("DiceRoll", $clientDataObj->updateClasses))) && in_array("defenseRoll", $clientDataObj->fieldsToUpdate) && ! isset($this->defenseRollIDJustCreated)) {
				(DiceRoll::childFromDB($this->defenseRollID))->updateInDB($clientDataObj->defenseRoll);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGameAttack",
				array("gameStateID", "attackingFigureID", "defendingFigureID", "attackRollID", "defenseRollID"),
				array($this->gameStateID, $this->attackingFigureID, $this->defendingFigureID, $this->attackRollID, $this->defenseRollID))->
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
			delete("OnlineGameAttack")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getGameState() {
		if ( ! property_exists($this, "gameState")) {
			$this->gameState = OnlineGameState::fromDB($this->gameStateID);
		}
		return $this->gameState;
	}

	public function getAttackingFigure() {
		if ( ! property_exists($this, "attackingFigure")) {
			$this->attackingFigure = OnlineGamePlayerFigure::fromDB($this->attackingFigureID);
		}
		return $this->attackingFigure;
	}

	public function getDefendingFigure() {
		if ( ! property_exists($this, "defendingFigure")) {
			$this->defendingFigure = OnlineGamePlayerFigure::fromDB($this->defendingFigureID);
		}
		return $this->defendingFigure;
	}

	public function getAttackRoll() {
		if ( ! property_exists($this, "attackRoll")) {
			$this->attackRoll = DiceRoll::childFromDB($this->attackRollID);
		}
		return $this->attackRoll;
	}

	public function getDefenseRoll() {
		if ($this->defenseRollID != null) {
			if ( ! property_exists($this, "defenseRoll")) {
				$this->defenseRoll = DiceRoll::childFromDB($this->defenseRollID);
			}
			return $this->defenseRoll;
		}
		return null;
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
