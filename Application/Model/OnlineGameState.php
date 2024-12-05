<?php

class OnlineGameState extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameID; // Int
	protected $timestamp; // Datetime

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGameState"])) {
			$OBJECT_MAP["OnlineGameState"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGameState"][$id])) {
			$obj = $OBJECT_MAP["OnlineGameState"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGameState"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->game->id)) {
			$clientDataObj->game = OnlineGame::create($clientDataObj->game);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGameState",
				array("gameID", "timestamp"),
				array($clientDataObj->game->id,
					$clientDataObj->timestamp)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss)) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				$clientLinkObj->om1GameState = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameStateFigures)) {
			foreach ($clientDataObj->onlineGameStateFigures as $clientLinkObj) {
				$clientLinkObj->gameState = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->diceRolls)) {
			foreach ($clientDataObj->diceRolls as $clientLinkObj) {
				$clientLinkObj->gameState = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameAttacks)) {
			foreach ($clientDataObj->onlineGameAttacks as $clientLinkObj) {
				$clientLinkObj->gameState = $this;
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
			$whereArray["{$prefix}OnlineGameState.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("game", $whereData)) {
				if (isset($whereData["game"]->id)) {
					$whereArray["{$prefix}OnlineGameState.gameID"] = $whereData["game"]->id;
				} else if ($whereData["game"] == null) {
					$whereArray["{$prefix}OnlineGameState.gameID"] = null;
				}
			}
			if (isset($whereData["timestamp"])) {
				$whereArray["{$prefix}OnlineGameState.timestamp"] = $whereData["timestamp"];
			}
		}
		
		if (isset($whereData["game"])) {
			$whereArray = array_merge($whereArray, OnlineGame::createWhereArray($whereData["game"], "{$prefix}OnlineGameState_gameID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGameState.name" => "ASC")
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
		return array("OnlineGameOrderMarkers" => "om1GameStateID", "OnlineGameStateFigure" => "gameStateID", "DiceRoll" => "gameStateID", "OnlineGameAttack" => "gameStateID");
	}

	public static function getForeignKeys() {
		return array("gameID" => "OnlineGame");
	}

	public static function getColumnNames() {
		return array("id", "gameID", "timestamp");
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
		if (OnlineGameOrderMarkers::countEntries(array("OnlineGameOrderMarkers.om1GameStateID" => $this->id)) > 0) {
			return "Unable to delete Online Game State because one or more Online Game Order Markers is dependent on it.";
		}
		if (OnlineGameStateFigure::countEntries(array("OnlineGameStateFigure.gameStateID" => $this->id)) > 0) {
			return "Unable to delete Online Game State because one or more Online Game State Figure is dependent on it.";
		}
		if (DiceRoll::countEntries(array("DiceRoll.gameStateID" => $this->id)) > 0) {
			return "Unable to delete Online Game State because one or more Dice Roll is dependent on it.";
		}
		if (OnlineGameAttack::countEntries(array("OnlineGameAttack.gameStateID" => $this->id)) > 0) {
			return "Unable to delete Online Game State because one or more Online Game Attack is dependent on it.";
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
			if (isset($clientDataObj->game, $clientDataObj->game->id) &&
					$clientDataObj->game->id > 0) {
					$this->gameID = $clientDataObj->game->id;
			}
			if (isset($clientDataObj->timestamp)) {
				$this->timestamp = $clientDataObj->timestamp;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->game) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGame", $clientDataObj->updateClasses))) && in_array("game", $clientDataObj->fieldsToUpdate) && ! isset($this->gameIDJustCreated)) {
				(OnlineGame::fromDB($this->gameID))->updateInDB($clientDataObj->game);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGameState",
				array("gameID", "timestamp"),
				array($this->gameID, $this->timestamp))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameOrderMarkers::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->om1GameState = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameStateFigures) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameStateFigures as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameStateFigure::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->gameState = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->diceRolls) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->diceRolls as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = DiceRoll::childFromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->gameState = $this;
					$clientLinkObj->childClassName::create($clientLinkObj);
				}
			}
		}
		if (isset($clientDataObj->onlineGameAttacks) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameAttacks as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameAttack::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->gameState = $this;
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
			delete("OnlineGameState")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getGame() {
		if ( ! property_exists($this, "game")) {
			$this->game = OnlineGame::fromDB($this->gameID);
		}
		return $this->game;
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
