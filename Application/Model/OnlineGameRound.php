<?php

class OnlineGameRound extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameID; // Int
	protected $number; // Int
	protected $started; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGameRound"])) {
			$OBJECT_MAP["OnlineGameRound"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGameRound"][$id])) {
			$obj = $OBJECT_MAP["OnlineGameRound"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGameRound"][$id] = $obj;
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
			insert("OnlineGameRound",
				array("gameID", "number", "started"),
				array($clientDataObj->game->id,
					$clientDataObj->number,
					isset($clientDataObj->started) && $clientDataObj-> started ? true : false)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss)) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				$clientLinkObj->round = $this;
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
			$whereArray["{$prefix}OnlineGameRound.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("game", $whereData)) {
				if (isset($whereData["game"]->id)) {
					$whereArray["{$prefix}OnlineGameRound.gameID"] = $whereData["game"]->id;
				} else if ($whereData["game"] == null) {
					$whereArray["{$prefix}OnlineGameRound.gameID"] = null;
				}
			}
			if (isset($whereData["number"])) {
				$whereArray["{$prefix}OnlineGameRound.number"] = $whereData["number"];
			}
			if (isset($whereData["started"])) {
				$whereArray["{$prefix}OnlineGameRound.started"] = $whereData["started"];
			}
		}
		
		if (isset($whereData["game"])) {
			$whereArray = array_merge($whereArray, OnlineGame::createWhereArray($whereData["game"], "{$prefix}OnlineGameRound_gameID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGameRound.name" => "ASC")
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
		return array("OnlineGameOrderMarkers" => "roundID");
	}

	public static function getForeignKeys() {
		return array("gameID" => "OnlineGame");
	}

	public static function getColumnNames() {
		return array("id", "gameID", "number", "started");
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
		if (OnlineGameOrderMarkers::countEntries(array("OnlineGameOrderMarkers.roundID" => $this->id)) > 0) {
			return "Unable to delete Online Game Round because one or more Online Game Order Markers is dependent on it.";
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
			if (isset($clientDataObj->number)) {
				$this->number = $clientDataObj->number;
			}
			if (isset($clientDataObj->started)) {
				$this->started = $clientDataObj->started;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->game) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGame", $clientDataObj->updateClasses))) && in_array("game", $clientDataObj->fieldsToUpdate) && ! isset($this->gameIDJustCreated)) {
				(OnlineGame::fromDB($this->gameID))->updateInDB($clientDataObj->game);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGameRound",
				array("gameID", "number", "started"),
				array($this->gameID, $this->number, $this->started))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGameOrderMarkerss) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameOrderMarkerss as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameOrderMarkers::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->round = $this;
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
			delete("OnlineGameRound")->
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
