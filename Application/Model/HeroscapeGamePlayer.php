<?php

class HeroscapeGamePlayer extends HS_DatabaseObject {
	protected $id; // Int
	protected $playerID; // Int
	protected $gameID; // Int
	protected $result; // Decimal
	protected $pointsLeft; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeGamePlayer"])) {
			$OBJECT_MAP["HeroscapeGamePlayer"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeGamePlayer"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeGamePlayer"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeGamePlayer"][$id] = $obj;
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
		if ( ! isset($clientDataObj->game->gameID)) {
			$clientDataObj->game = HeroscapeGame::create($clientDataObj->game);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeGamePlayer",
				array("playerID", "gameID", "result", "pointsLeft"),
				array($clientDataObj->player->id,
					$clientDataObj->game->gameID,
					$clientDataObj->result,
					$clientDataObj->pointsLeft)));
		
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
			$whereArray["{$prefix}HeroscapeGamePlayer.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}HeroscapeGamePlayer.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}HeroscapeGamePlayer.playerID"] = null;
				}
			}
			if (array_key_exists("game", $whereData)) {
				if (isset($whereData["game"]->gameID)) {
					$whereArray["{$prefix}HeroscapeGamePlayer.gameID"] = $whereData["game"]->gameID;
				} else if ($whereData["game"] == null) {
					$whereArray["{$prefix}HeroscapeGamePlayer.gameID"] = null;
				}
			}
			if (isset($whereData["result"])) {
				$whereArray["{$prefix}HeroscapeGamePlayer.result"] = $whereData["result"];
			}
			if (isset($whereData["pointsLeft"])) {
				$whereArray["{$prefix}HeroscapeGamePlayer.pointsLeft"] = $whereData["pointsLeft"];
			}
		}
		
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, Player::createWhereArray($whereData["player"], "{$prefix}HeroscapeGamePlayer_playerID_"));
		}
		if (isset($whereData["game"])) {
			$whereArray = array_merge($whereArray, HeroscapeGame::createWhereArray($whereData["game"], "{$prefix}HeroscapeGamePlayer_gameID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("HeroscapeGamePlayer.name" => "ASC")
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
		return array("playerID" => "Player", "gameID" => "HeroscapeGame");
	}

	public static function getColumnNames() {
		return array("id", "playerID", "gameID", "result", "pointsLeft");
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
			if (isset($clientDataObj->player, $clientDataObj->player->id) &&
					$clientDataObj->player->id > 0) {
					$this->playerID = $clientDataObj->player->id;
			}
			if (isset($clientDataObj->game, $clientDataObj->game->gameID) &&
					$clientDataObj->game->gameID > 0) {
					$this->gameID = $clientDataObj->game->gameID;
			}
			if (property_exists($clientDataObj, "result")) {
				$this->result = $clientDataObj->result;
			}
			if (property_exists($clientDataObj, "pointsLeft")) {
				$this->pointsLeft = $clientDataObj->pointsLeft;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("Player", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(Player::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
			if (isset($clientDataObj->game) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeGame", $clientDataObj->updateClasses))) && in_array("game", $clientDataObj->fieldsToUpdate) && ! isset($this->gameIDJustCreated)) {
				(HeroscapeGame::fromDB($this->gameID))->updateInDB($clientDataObj->game);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeGamePlayer",
				array("playerID", "gameID", "result", "pointsLeft"),
				array($this->playerID, $this->gameID, $this->result, $this->pointsLeft))->
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
			delete("HeroscapeGamePlayer")->
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

	public function getGame() {
		if ( ! property_exists($this, "game")) {
			$this->game = HeroscapeGame::fromDB($this->gameID);
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
