<?php

class OnlineGameOrderMarkers extends HS_DatabaseObject {
	protected $id; // Int
	protected $roundID; // Int
	protected $playerID; // Int
	protected $initiativeID; // Int
	protected $om1CardID; // Int
	protected $om1GameStateID; // Int
	protected $om2CardID; // Int
	protected $om2GameStateID; // Int
	protected $om3CardID; // Int
	protected $om3GameStateID; // Int
	protected $omXCardID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGameOrderMarkers"])) {
			$OBJECT_MAP["OnlineGameOrderMarkers"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGameOrderMarkers"][$id])) {
			$obj = $OBJECT_MAP["OnlineGameOrderMarkers"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGameOrderMarkers"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->round->id)) {
			$clientDataObj->round = OnlineGameRound::create($clientDataObj->round);
		}
		if ( ! isset($clientDataObj->player->id)) {
			$clientDataObj->player = OnlineGamePlayer::create($clientDataObj->player);
		}
		if ( ! isset($clientDataObj->initiative->diceRollID)) {
			$clientDataObj->initiative = D20Roll::create($clientDataObj->initiative);
		}
		if ( ! isset($clientDataObj->om1Card->id)) {
			$clientDataObj->om1Card = HeroscapeCard::create($clientDataObj->om1Card);
		}
		if ( ! isset($clientDataObj->om1GameState->id)) {
			$clientDataObj->om1GameState = OnlineGameState::create($clientDataObj->om1GameState);
		}
		if ( ! isset($clientDataObj->om2Card->id)) {
			$clientDataObj->om2Card = HeroscapeCard::create($clientDataObj->om2Card);
		}
		if ( ! isset($clientDataObj->om2GameState->id)) {
			$clientDataObj->om2GameState = OnlineGameState::create($clientDataObj->om2GameState);
		}
		if ( ! isset($clientDataObj->om3Card->id)) {
			$clientDataObj->om3Card = HeroscapeCard::create($clientDataObj->om3Card);
		}
		if ( ! isset($clientDataObj->om3GameState->id)) {
			$clientDataObj->om3GameState = OnlineGameState::create($clientDataObj->om3GameState);
		}
		if ( ! isset($clientDataObj->omXCard->id)) {
			$clientDataObj->omXCard = HeroscapeCard::create($clientDataObj->omXCard);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGameOrderMarkers",
				array("roundID", "playerID", "initiativeID", "om1CardID", "om1GameStateID", "om2CardID", "om2GameStateID", "om3CardID", "om3GameStateID", "omXCardID"),
				array($clientDataObj->round->id,
					$clientDataObj->player->id,
					$clientDataObj->initiative->diceRollID,
					$clientDataObj->om1Card->id,
					$clientDataObj->om1GameState->id,
					$clientDataObj->om2Card->id,
					$clientDataObj->om2GameState->id,
					$clientDataObj->om3Card->id,
					$clientDataObj->om3GameState->id,
					$clientDataObj->omXCard->id)));
		
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
			$whereArray["{$prefix}OnlineGameOrderMarkers.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("round", $whereData)) {
				if (isset($whereData["round"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.roundID"] = $whereData["round"]->id;
				} else if ($whereData["round"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.roundID"] = null;
				}
			}
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.playerID"] = null;
				}
			}
			if (array_key_exists("initiative", $whereData)) {
				if (isset($whereData["initiative"]->diceRollID)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.initiativeID"] = $whereData["initiative"]->diceRollID;
				} else if ($whereData["initiative"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.initiativeID"] = null;
				}
			}
			if (array_key_exists("om1Card", $whereData)) {
				if (isset($whereData["om1Card"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om1CardID"] = $whereData["om1Card"]->id;
				} else if ($whereData["om1Card"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om1CardID"] = null;
				}
			}
			if (array_key_exists("om1GameState", $whereData)) {
				if (isset($whereData["om1GameState"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om1GameStateID"] = $whereData["om1GameState"]->id;
				} else if ($whereData["om1GameState"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om1GameStateID"] = null;
				}
			}
			if (array_key_exists("om2Card", $whereData)) {
				if (isset($whereData["om2Card"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om2CardID"] = $whereData["om2Card"]->id;
				} else if ($whereData["om2Card"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om2CardID"] = null;
				}
			}
			if (array_key_exists("om2GameState", $whereData)) {
				if (isset($whereData["om2GameState"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om2GameStateID"] = $whereData["om2GameState"]->id;
				} else if ($whereData["om2GameState"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om2GameStateID"] = null;
				}
			}
			if (array_key_exists("om3Card", $whereData)) {
				if (isset($whereData["om3Card"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om3CardID"] = $whereData["om3Card"]->id;
				} else if ($whereData["om3Card"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om3CardID"] = null;
				}
			}
			if (array_key_exists("om3GameState", $whereData)) {
				if (isset($whereData["om3GameState"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om3GameStateID"] = $whereData["om3GameState"]->id;
				} else if ($whereData["om3GameState"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.om3GameStateID"] = null;
				}
			}
			if (array_key_exists("omXCard", $whereData)) {
				if (isset($whereData["omXCard"]->id)) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.omXCardID"] = $whereData["omXCard"]->id;
				} else if ($whereData["omXCard"] == null) {
					$whereArray["{$prefix}OnlineGameOrderMarkers.omXCardID"] = null;
				}
			}
		}
		
		if (isset($whereData["round"])) {
			$whereArray = array_merge($whereArray, OnlineGameRound::createWhereArray($whereData["round"], "{$prefix}OnlineGameOrderMarkers_roundID_"));
		}
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, OnlineGamePlayer::createWhereArray($whereData["player"], "{$prefix}OnlineGameOrderMarkers_playerID_"));
		}
		if (isset($whereData["initiative"])) {
			$whereArray = array_merge($whereArray, D20Roll::createWhereArray($whereData["initiative"], "{$prefix}OnlineGameOrderMarkers_initiativeID_"));
		}
		if (isset($whereData["om1Card"])) {
			$whereArray = array_merge($whereArray, HeroscapeCard::createWhereArray($whereData["om1Card"], "{$prefix}OnlineGameOrderMarkers_om1CardID_"));
		}
		if (isset($whereData["om1GameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["om1GameState"], "{$prefix}OnlineGameOrderMarkers_om1GameStateID_"));
		}
		if (isset($whereData["om2Card"])) {
			$whereArray = array_merge($whereArray, HeroscapeCard::createWhereArray($whereData["om2Card"], "{$prefix}OnlineGameOrderMarkers_om2CardID_"));
		}
		if (isset($whereData["om2GameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["om2GameState"], "{$prefix}OnlineGameOrderMarkers_om2GameStateID_"));
		}
		if (isset($whereData["om3Card"])) {
			$whereArray = array_merge($whereArray, HeroscapeCard::createWhereArray($whereData["om3Card"], "{$prefix}OnlineGameOrderMarkers_om3CardID_"));
		}
		if (isset($whereData["om3GameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["om3GameState"], "{$prefix}OnlineGameOrderMarkers_om3GameStateID_"));
		}
		if (isset($whereData["omXCard"])) {
			$whereArray = array_merge($whereArray, HeroscapeCard::createWhereArray($whereData["omXCard"], "{$prefix}OnlineGameOrderMarkers_omXCardID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGameOrderMarkers.name" => "ASC")
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
		return array("roundID" => "OnlineGameRound", "playerID" => "OnlineGamePlayer", "initiativeID" => "D20Roll", "om1CardID" => "HeroscapeCard", "om1GameStateID" => "OnlineGameState", "om2CardID" => "HeroscapeCard", "om2GameStateID" => "OnlineGameState", "om3CardID" => "HeroscapeCard", "om3GameStateID" => "OnlineGameState", "omXCardID" => "HeroscapeCard");
	}

	public static function getColumnNames() {
		return array("id", "roundID", "playerID", "initiativeID", "om1CardID", "om1GameStateID", "om2CardID", "om2GameStateID", "om3CardID", "om3GameStateID", "omXCardID");
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
			if (isset($clientDataObj->round, $clientDataObj->round->id) &&
					$clientDataObj->round->id > 0) {
					$this->roundID = $clientDataObj->round->id;
			}
			if (isset($clientDataObj->player, $clientDataObj->player->id) &&
					$clientDataObj->player->id > 0) {
					$this->playerID = $clientDataObj->player->id;
			}
			if (isset($clientDataObj->initiative, $clientDataObj->initiative->diceRollID) &&
					$clientDataObj->initiative->diceRollID > 0) {
					$this->initiativeID = $clientDataObj->initiative->diceRollID;
			}
			if (isset($clientDataObj->om1Card, $clientDataObj->om1Card->id) &&
					$clientDataObj->om1Card->id > 0) {
					$this->om1CardID = $clientDataObj->om1Card->id;
			}
			if (isset($clientDataObj->om1GameState, $clientDataObj->om1GameState->id) &&
					$clientDataObj->om1GameState->id > 0) {
					$this->om1GameStateID = $clientDataObj->om1GameState->id;
			}
			if (isset($clientDataObj->om2Card, $clientDataObj->om2Card->id) &&
					$clientDataObj->om2Card->id > 0) {
					$this->om2CardID = $clientDataObj->om2Card->id;
			}
			if (isset($clientDataObj->om2GameState, $clientDataObj->om2GameState->id) &&
					$clientDataObj->om2GameState->id > 0) {
					$this->om2GameStateID = $clientDataObj->om2GameState->id;
			}
			if (isset($clientDataObj->om3Card, $clientDataObj->om3Card->id) &&
					$clientDataObj->om3Card->id > 0) {
					$this->om3CardID = $clientDataObj->om3Card->id;
			}
			if (isset($clientDataObj->om3GameState, $clientDataObj->om3GameState->id) &&
					$clientDataObj->om3GameState->id > 0) {
					$this->om3GameStateID = $clientDataObj->om3GameState->id;
			}
			if (isset($clientDataObj->omXCard, $clientDataObj->omXCard->id) &&
					$clientDataObj->omXCard->id > 0) {
					$this->omXCardID = $clientDataObj->omXCard->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->round) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameRound", $clientDataObj->updateClasses))) && in_array("round", $clientDataObj->fieldsToUpdate) && ! isset($this->roundIDJustCreated)) {
				(OnlineGameRound::fromDB($this->roundID))->updateInDB($clientDataObj->round);
			}
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGamePlayer", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(OnlineGamePlayer::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
			if (isset($clientDataObj->initiative) && ( ! isset($clientDataObj->updateClasses) || (in_array("D20Roll", $clientDataObj->updateClasses))) && in_array("initiative", $clientDataObj->fieldsToUpdate) && ! isset($this->initiativeIDJustCreated)) {
				(D20Roll::fromDB($this->initiativeID))->updateInDB($clientDataObj->initiative);
			}
			if (isset($clientDataObj->om1Card) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeCard", $clientDataObj->updateClasses))) && in_array("om1Card", $clientDataObj->fieldsToUpdate) && ! isset($this->om1CardIDJustCreated)) {
				(HeroscapeCard::fromDB($this->om1CardID))->updateInDB($clientDataObj->om1Card);
			}
			if (isset($clientDataObj->om1GameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("om1GameState", $clientDataObj->fieldsToUpdate) && ! isset($this->om1GameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->om1GameStateID))->updateInDB($clientDataObj->om1GameState);
			}
			if (isset($clientDataObj->om2Card) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeCard", $clientDataObj->updateClasses))) && in_array("om2Card", $clientDataObj->fieldsToUpdate) && ! isset($this->om2CardIDJustCreated)) {
				(HeroscapeCard::fromDB($this->om2CardID))->updateInDB($clientDataObj->om2Card);
			}
			if (isset($clientDataObj->om2GameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("om2GameState", $clientDataObj->fieldsToUpdate) && ! isset($this->om2GameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->om2GameStateID))->updateInDB($clientDataObj->om2GameState);
			}
			if (isset($clientDataObj->om3Card) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeCard", $clientDataObj->updateClasses))) && in_array("om3Card", $clientDataObj->fieldsToUpdate) && ! isset($this->om3CardIDJustCreated)) {
				(HeroscapeCard::fromDB($this->om3CardID))->updateInDB($clientDataObj->om3Card);
			}
			if (isset($clientDataObj->om3GameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("om3GameState", $clientDataObj->fieldsToUpdate) && ! isset($this->om3GameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->om3GameStateID))->updateInDB($clientDataObj->om3GameState);
			}
			if (isset($clientDataObj->omXCard) && ( ! isset($clientDataObj->updateClasses) || (in_array("HeroscapeCard", $clientDataObj->updateClasses))) && in_array("omXCard", $clientDataObj->fieldsToUpdate) && ! isset($this->omXCardIDJustCreated)) {
				(HeroscapeCard::fromDB($this->omXCardID))->updateInDB($clientDataObj->omXCard);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGameOrderMarkers",
				array("roundID", "playerID", "initiativeID", "om1CardID", "om1GameStateID", "om2CardID", "om2GameStateID", "om3CardID", "om3GameStateID", "omXCardID"),
				array($this->roundID, $this->playerID, $this->initiativeID, $this->om1CardID, $this->om1GameStateID, $this->om2CardID, $this->om2GameStateID, $this->om3CardID, $this->om3GameStateID, $this->omXCardID))->
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
			delete("OnlineGameOrderMarkers")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getRound() {
		if ( ! property_exists($this, "round")) {
			$this->round = OnlineGameRound::fromDB($this->roundID);
		}
		return $this->round;
	}

	public function getPlayer() {
		if ( ! property_exists($this, "player")) {
			$this->player = OnlineGamePlayer::fromDB($this->playerID);
		}
		return $this->player;
	}

	public function getInitiative() {
		if ( ! property_exists($this, "initiative")) {
			$this->initiative = D20Roll::fromDB($this->initiativeID);
		}
		return $this->initiative;
	}

	public function getOm1Card() {
		if ( ! property_exists($this, "om1Card")) {
			$this->om1Card = HeroscapeCard::fromDB($this->om1CardID);
		}
		return $this->om1Card;
	}

	public function getOm1GameState() {
		if ( ! property_exists($this, "om1GameState")) {
			$this->om1GameState = OnlineGameState::fromDB($this->om1GameStateID);
		}
		return $this->om1GameState;
	}

	public function getOm2Card() {
		if ( ! property_exists($this, "om2Card")) {
			$this->om2Card = HeroscapeCard::fromDB($this->om2CardID);
		}
		return $this->om2Card;
	}

	public function getOm2GameState() {
		if ( ! property_exists($this, "om2GameState")) {
			$this->om2GameState = OnlineGameState::fromDB($this->om2GameStateID);
		}
		return $this->om2GameState;
	}

	public function getOm3Card() {
		if ( ! property_exists($this, "om3Card")) {
			$this->om3Card = HeroscapeCard::fromDB($this->om3CardID);
		}
		return $this->om3Card;
	}

	public function getOm3GameState() {
		if ( ! property_exists($this, "om3GameState")) {
			$this->om3GameState = OnlineGameState::fromDB($this->om3GameStateID);
		}
		return $this->om3GameState;
	}

	public function getOmXCard() {
		if ( ! property_exists($this, "omXCard")) {
			$this->omXCard = HeroscapeCard::fromDB($this->omXCardID);
		}
		return $this->omXCard;
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
