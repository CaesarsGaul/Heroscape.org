<?php

class OnlineGameStateFigure extends HS_DatabaseObject {
	protected $id; // Int
	protected $gameStateID; // Int
	protected $figureID; // Int
	protected $wounds; // Int
	protected $rowNum; // Int
	protected $colNum; // Int
	protected $facingDirection; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["OnlineGameStateFigure"])) {
			$OBJECT_MAP["OnlineGameStateFigure"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["OnlineGameStateFigure"][$id])) {
			$obj = $OBJECT_MAP["OnlineGameStateFigure"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["OnlineGameStateFigure"][$id] = $obj;
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
		if ( ! isset($clientDataObj->figure->id)) {
			$clientDataObj->figure = OnlineGamePlayerFigure::create($clientDataObj->figure);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("OnlineGameStateFigure",
				array("gameStateID", "figureID", "wounds", "rowNum", "colNum", "facingDirection"),
				array($clientDataObj->gameState->id,
					$clientDataObj->figure->id,
					$clientDataObj->wounds,
					$clientDataObj->rowNum,
					$clientDataObj->colNum,
					$clientDataObj->facingDirection)));
		
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
			$whereArray["{$prefix}OnlineGameStateFigure.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("gameState", $whereData)) {
				if (isset($whereData["gameState"]->id)) {
					$whereArray["{$prefix}OnlineGameStateFigure.gameStateID"] = $whereData["gameState"]->id;
				} else if ($whereData["gameState"] == null) {
					$whereArray["{$prefix}OnlineGameStateFigure.gameStateID"] = null;
				}
			}
			if (array_key_exists("figure", $whereData)) {
				if (isset($whereData["figure"]->id)) {
					$whereArray["{$prefix}OnlineGameStateFigure.figureID"] = $whereData["figure"]->id;
				} else if ($whereData["figure"] == null) {
					$whereArray["{$prefix}OnlineGameStateFigure.figureID"] = null;
				}
			}
			if (isset($whereData["wounds"])) {
				$whereArray["{$prefix}OnlineGameStateFigure.wounds"] = $whereData["wounds"];
			}
			if (isset($whereData["rowNum"])) {
				$whereArray["{$prefix}OnlineGameStateFigure.rowNum"] = $whereData["rowNum"];
			}
			if (isset($whereData["colNum"])) {
				$whereArray["{$prefix}OnlineGameStateFigure.colNum"] = $whereData["colNum"];
			}
			if (isset($whereData["facingDirection"])) {
				$whereArray["{$prefix}OnlineGameStateFigure.facingDirection"] = $whereData["facingDirection"];
			}
		}
		
		if (isset($whereData["gameState"])) {
			$whereArray = array_merge($whereArray, OnlineGameState::createWhereArray($whereData["gameState"], "{$prefix}OnlineGameStateFigure_gameStateID_"));
		}
		if (isset($whereData["figure"])) {
			$whereArray = array_merge($whereArray, OnlineGamePlayerFigure::createWhereArray($whereData["figure"], "{$prefix}OnlineGameStateFigure_figureID_"));
		}
		
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("OnlineGameStateFigure.name" => "ASC")
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
		return array("gameStateID" => "OnlineGameState", "figureID" => "OnlineGamePlayerFigure");
	}

	public static function getColumnNames() {
		return array("id", "gameStateID", "figureID", "wounds", "rowNum", "colNum", "facingDirection");
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
			if (isset($clientDataObj->figure, $clientDataObj->figure->id) &&
					$clientDataObj->figure->id > 0) {
					$this->figureID = $clientDataObj->figure->id;
			}
			if (isset($clientDataObj->wounds)) {
				$this->wounds = $clientDataObj->wounds;
			}
			if (isset($clientDataObj->rowNum)) {
				$this->rowNum = $clientDataObj->rowNum;
			}
			if (isset($clientDataObj->colNum)) {
				$this->colNum = $clientDataObj->colNum;
			}
			if (isset($clientDataObj->facingDirection)) {
				$this->facingDirection = $clientDataObj->facingDirection;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->gameState) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGameState", $clientDataObj->updateClasses))) && in_array("gameState", $clientDataObj->fieldsToUpdate) && ! isset($this->gameStateIDJustCreated)) {
				(OnlineGameState::fromDB($this->gameStateID))->updateInDB($clientDataObj->gameState);
			}
			if (isset($clientDataObj->figure) && ( ! isset($clientDataObj->updateClasses) || (in_array("OnlineGamePlayerFigure", $clientDataObj->updateClasses))) && in_array("figure", $clientDataObj->fieldsToUpdate) && ! isset($this->figureIDJustCreated)) {
				(OnlineGamePlayerFigure::fromDB($this->figureID))->updateInDB($clientDataObj->figure);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("OnlineGameStateFigure",
				array("gameStateID", "figureID", "wounds", "rowNum", "colNum", "facingDirection"),
				array($this->gameStateID, $this->figureID, $this->wounds, $this->rowNum, $this->colNum, $this->facingDirection))->
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
			delete("OnlineGameStateFigure")->
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

	public function getFigure() {
		if ( ! property_exists($this, "figure")) {
			$this->figure = OnlineGamePlayerFigure::fromDB($this->figureID);
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
