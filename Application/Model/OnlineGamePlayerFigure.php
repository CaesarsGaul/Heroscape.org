<?php

class OnlineGamePlayerFigure extends HS_DatabaseObject {
	protected $id; // Int
	protected $playerID; // Int
	protected $figureID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGamePlayerFigure"])) {
			$OBJECT_MAP["OnlineGamePlayerFigure"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGamePlayerFigure"][$id])) {
			$obj = $OBJECT_MAP["OnlineGamePlayerFigure"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGamePlayerFigure"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if ( ! isset($clientDataObj->player->id)) {
			$clientDataObj->player = OnlineGamePlayer::create($clientDataObj->player);
		}
		if ( ! isset($clientDataObj->figure->id)) {
			$clientDataObj->figure = Figure::create($clientDataObj->figure);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGamePlayerFigure",
				array("playerID", "figureID"),
				array($clientDataObj->player->id,
					$clientDataObj->figure->id)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->onlineGameStateFigures)) {
			foreach ($clientDataObj->onlineGameStateFigures as $clientLinkObj) {
				$clientLinkObj->figure = $this;
				$clientLinkObj->childClassName::create($clientLinkObj);
			}
		}
		if (isset($clientDataObj->onlineGameAttacks)) {
			foreach ($clientDataObj->onlineGameAttacks as $clientLinkObj) {
				$clientLinkObj->attackingFigure = $this;
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
			$whereArray["{$prefix}OnlineGamePlayerFigure.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("player", $whereData)) {
				if (isset($whereData["player"]->id)) {
					$whereArray["{$prefix}OnlineGamePlayerFigure.playerID"] = $whereData["player"]->id;
				} else if ($whereData["player"] == null) {
					$whereArray["{$prefix}OnlineGamePlayerFigure.playerID"] = null;
				}
			}
			if (array_key_exists("figure", $whereData)) {
				if (isset($whereData["figure"]->id)) {
					$whereArray["{$prefix}OnlineGamePlayerFigure.figureID"] = $whereData["figure"]->id;
				} else if ($whereData["figure"] == null) {
					$whereArray["{$prefix}OnlineGamePlayerFigure.figureID"] = null;
				}
			}
		}
		
		if (isset($whereData["player"])) {
			$whereArray = array_merge($whereArray, OnlineGamePlayer::createWhereArray($whereData["player"], "{$prefix}OnlineGamePlayerFigure_playerID_"));
		}
		if (isset($whereData["figure"])) {
			$whereArray = array_merge($whereArray, Figure::createWhereArray($whereData["figure"], "{$prefix}OnlineGamePlayerFigure_figureID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGamePlayerFigure.name" => "ASC")
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
		return array("OnlineGameStateFigure" => "figureID", "OnlineGameAttack" => "attackingFigureID");
	}

	public static function getForeignKeys() {
		return array("playerID" => "OnlineGamePlayer", "figureID" => "Figure");
	}

	public static function getColumnNames() {
		return array("id", "playerID", "figureID");
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
		if (OnlineGameStateFigure::countEntries(array("OnlineGameStateFigure.figureID" => $this->id)) > 0) {
			return "Unable to delete Online Game Player Figure because one or more Online Game State Figure is dependent on it.";
		}
		if (OnlineGameAttack::countEntries(array("OnlineGameAttack.attackingFigureID" => $this->id)) > 0) {
			return "Unable to delete Online Game Player Figure because one or more Online Game Attack is dependent on it.";
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
			if (isset($clientDataObj->player, $clientDataObj->player->id) &&
					$clientDataObj->player->id > 0) {
					$this->playerID = $clientDataObj->player->id;
			}
			if (isset($clientDataObj->figure, $clientDataObj->figure->id) &&
					$clientDataObj->figure->id > 0) {
					$this->figureID = $clientDataObj->figure->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->player) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGamePlayer", $clientDataObj->updateClasses))) && in_array("player", $clientDataObj->fieldsToUpdate) && ! isset($this->playerIDJustCreated)) {
				(OnlineGamePlayer::fromDB($this->playerID))->updateInDB($clientDataObj->player);
			}
			if (isset($clientDataObj->figure) && ( ! isset($clientDataObj->updateClasses) || (in_array("Figure", $clientDataObj->updateClasses))) && in_array("figure", $clientDataObj->fieldsToUpdate) && ! isset($this->figureIDJustCreated)) {
				(Figure::fromDB($this->figureID))->updateInDB($clientDataObj->figure);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGamePlayerFigure",
				array("playerID", "figureID"),
				array($this->playerID, $this->figureID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->onlineGameStateFigures) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->onlineGameStateFigures as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = OnlineGameStateFigure::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->figure = $this;
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
					$clientLinkObj->attackingFigure = $this;
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
			delete("OnlineGamePlayerFigure")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getPlayer() {
		if ( ! property_exists($this, "player")) {
			$this->player = OnlineGamePlayer::fromDB($this->playerID);
		}
		return $this->player;
	}

	public function getFigure() {
		if ( ! property_exists($this, "figure")) {
			$this->figure = Figure::fromDB($this->figureID);
		}
		return $this->figure;
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
