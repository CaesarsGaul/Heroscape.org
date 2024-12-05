<?php

class Round extends HS_DatabaseObject {
	protected $id; // Int
	protected $tournamentID; // Int
	protected $name; // String
	protected $order; // Int
	protected $started; // Boolean

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Round"])) {
			$OBJECT_MAP["Round"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Round"][$id])) {
			$obj = $OBJECT_MAP["Round"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Round"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Round",
				array("tournamentID", "name", "order", "started"),
				array($clientDataObj->tournament->id,
					$clientDataObj->name,
					self::countEntries(parent::orderWhereArrayFromClientDataObj($clientDataObj)),
					isset($clientDataObj->started) && $clientDataObj-> started ? true : false)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->games)) {
			foreach ($clientDataObj->games as $clientLinkObj) {
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
			$whereArray["{$prefix}Round.id"] = $whereData["id"];
		}
		else {
			if (array_key_exists("tournament", $whereData)) {
				if (isset($whereData["tournament"]->id)) {
					$whereArray["{$prefix}Round.tournamentID"] = $whereData["tournament"]->id;
				} else if ($whereData["tournament"] == null) {
					$whereArray["{$prefix}Round.tournamentID"] = null;
				}
			}
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Round.name"] = $whereData["name"];
			}
			if (isset($whereData["started"])) {
				$whereArray["{$prefix}Round.started"] = $whereData["started"];
			}
		}
		
		if (isset($whereData["tournament"])) {
			$whereArray = array_merge($whereArray, Tournament::createWhereArray($whereData["tournament"], "{$prefix}Round_tournamentID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("LENGTH(Round.order)" => "ASC", "Round.order" => "ASC");
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
		return array("Game" => "roundID");
	}

	public static function getForeignKeys() {
		return array("tournamentID" => "Tournament");
	}

	public static function getColumnNames() {
		return array("id", "tournamentID", "name", "order", "started");
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
		return false;
	}

	// @DoNotUpdate
	public function isViewableByUser() {
		if ($this->started) {
			return true;
		}
		if (LoginCredentials::userLoggedIn()) {
			$user = LoginCredentials::getLoggedInUser();
			$tournament = $this->getTournament();
			return $tournament->isEditableByUser();
			/*return Admin::exists(array(
				"userID" => $user->id, 
				"tournamentID" => $tournament->id));*/
		}
		return false;
	}

	// @DoNotUpdate
	public static function userCanCreate($implicitObjects=null) {
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

	// @DoNotUpdate
	public static function columnsForOrderGroup() {
		return array("tournamentID");
	}

	protected function deleteLinks() {
		// N-1 Links
		if (Game::countEntries(array("Game.roundID" => $this->id)) > 0) {
			return "Unable to delete Round because one or more Game is dependent on it.";
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
			if (isset($clientDataObj->tournament, $clientDataObj->tournament->id) &&
					$clientDataObj->tournament->id > 0) {
					$this->tournamentID = $clientDataObj->tournament->id;
			}
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->order)) {
				$this->order = $clientDataObj->order;
			}
			if (isset($clientDataObj->started)) {
				$this->started = $clientDataObj->started;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->tournament) && ( ! isset($clientDataObj->updateClasses) || (in_array("Tournament", $clientDataObj->updateClasses))) && in_array("tournament", $clientDataObj->fieldsToUpdate) && ! isset($this->tournamentIDJustCreated)) {
				(Tournament::childFromDB($this->tournamentID))->updateInDB($clientDataObj->tournament);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Round",
				array("tournamentID", "name", "order", "started"),
				array($this->tournamentID, $this->name, $this->order, $this->started))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->games) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->games as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Game::childFromDB($clientLinkObj->id);
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
			delete("Round")->
			where(array("id" => $this->id)));
		
		self::cleanOrder($this->orderWhereArray());
		
		return "";
	}

	/* Getters */
	
	public function getTournament() {
		if ( ! property_exists($this, "tournament")) {
			$this->tournament = Tournament::childFromDB($this->tournamentID);
		}
		return $this->tournament;
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
