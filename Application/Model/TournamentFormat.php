<?php

class TournamentFormat extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $impactBuilder; // Boolean
	protected $description; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["TournamentFormat"])) {
			$OBJECT_MAP["TournamentFormat"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["TournamentFormat"][$id])) {
			$obj = $OBJECT_MAP["TournamentFormat"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["TournamentFormat"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("TournamentFormat",
				array("name", "impactBuilder", "description"),
				array($clientDataObj->name,
					isset($clientDataObj->impactBuilder) && $clientDataObj-> impactBuilder ? true : false,
					$clientDataObj->description)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->tournamentFormatTags)) {
			foreach ($clientDataObj->tournamentFormatTags as $clientLinkObj) {
				$clientLinkObj->format = $this;
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
			$whereArray["{$prefix}TournamentFormat.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}TournamentFormat.name"] = $whereData["name"];
			}
			if (isset($whereData["impactBuilder"])) {
				$whereArray["{$prefix}TournamentFormat.impactBuilder"] = $whereData["impactBuilder"];
			}
			if (isset($whereData["description"])) {
				$whereArray["{$prefix}TournamentFormat.description"] = $whereData["description"];
			}
		}
		
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("TournamentFormat.name" => "ASC");
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
		return array("TournamentFormatTag" => "formatID");
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "name", "impactBuilder", "description");
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
		if (TournamentFormatTag::countEntries(array("TournamentFormatTag.formatID" => $this->id)) > 0) {
			return "Unable to delete Tournament Format because one or more Tournament Format Tag is dependent on it.";
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
			if (isset($clientDataObj->name)) {
				$this->name = $clientDataObj->name;
			}
			if (isset($clientDataObj->impactBuilder)) {
				$this->impactBuilder = $clientDataObj->impactBuilder;
			}
			if (property_exists($clientDataObj, "description")) {
				$this->description = $clientDataObj->description;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("TournamentFormat",
				array("name", "impactBuilder", "description"),
				array($this->name, $this->impactBuilder, $this->description))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->tournamentFormatTags) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->tournamentFormatTags as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = TournamentFormatTag::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->format = $this;
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
			delete("TournamentFormat")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
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
