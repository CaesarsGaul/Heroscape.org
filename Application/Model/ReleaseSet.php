<?php

class ReleaseSet extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $releaseDate; // Date
	protected $figureSubSetGroupID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["ReleaseSet"])) {
			$OBJECT_MAP["ReleaseSet"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["ReleaseSet"][$id])) {
			$obj = $OBJECT_MAP["ReleaseSet"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["ReleaseSet"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_id($id, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("id" => $id));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->id) && self::exists(array("id" => $clientDataObj->id))) {
			return "A Release Set already exists with that id - you cannot have duplicate entries.";
		}
		
		if (isset($clientDataObj->figureSubSetGroup) &&
				! isset($clientDataObj->figureSubSetGroup->id)) {
			$clientDataObj->figureSubSetGroup = FigureSetSubGroup::create($clientDataObj->figureSubSetGroup);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("ReleaseSet",
				array("name", "releaseDate", "figureSubSetGroupID"),
				array($clientDataObj->name,
					$clientDataObj->releaseDate,
					isset($clientDataObj->figureSubSetGroup) 
						? $clientDataObj->figureSubSetGroup->id
						: null)));
		
		$dbObj = self::fromDB($id);
		
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->cards)) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				$clientLinkObj->releaseSet = $this;
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
			$whereArray["{$prefix}ReleaseSet.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}ReleaseSet.name"] = $whereData["name"];
			}
			if (isset($whereData["releaseDate"])) {
				$whereArray["{$prefix}ReleaseSet.releaseDate"] = $whereData["releaseDate"];
			}
			if (array_key_exists("figureSubSetGroup", $whereData)) {
				if (isset($whereData["figureSubSetGroup"]->id)) {
					$whereArray["{$prefix}ReleaseSet.figureSubSetGroupID"] = $whereData["figureSubSetGroup"]->id;
				} else if ($whereData["figureSubSetGroup"] == null) {
					$whereArray["{$prefix}ReleaseSet.figureSubSetGroupID"] = null;
				}
			}
		}
		
		if (isset($whereData["figureSubSetGroup"])) {
			$whereArray = array_merge($whereArray, FigureSetSubGroup::createWhereArray($whereData["figureSubSetGroup"], "{$prefix}ReleaseSet_figureSubSetGroupID_"));
		}
		
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("ReleaseSet.releaseDate" => "ASC");
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
		return array("Card" => "releaseSetID");
	}

	public static function getForeignKeys() {
		return array("figureSubSetGroupID" => "FigureSetSubGroup");
	}

	public static function getColumnNames() {
		return array("id", "name", "releaseDate", "figureSubSetGroupID");
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
		if (Card::countEntries(array("Card.releaseSetID" => $this->id)) > 0) {
			return "Unable to delete Release Set because one or more Card is dependent on it.";
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
			if (isset($clientDataObj->releaseDate)) {
				$this->releaseDate = $clientDataObj->releaseDate;
			}
			if (property_exists($clientDataObj, "figureSubSetGroup")) {
				if (isset($clientDataObj->figureSubSetGroup)) {
					if (isset($clientDataObj->figureSubSetGroup->id) && $clientDataObj->figureSubSetGroup->id > 0) {
						$this->figureSubSetGroupID = $clientDataObj->figureSubSetGroup->id;
					} else {
						$this->figureSubSetGroupID = (FigureSetSubGroup::create($clientDataObj->figureSubSetGroup))->id;
						$this->figureSubSetGroupIDJustCreated = true;
					}
				} else {
					$this->figureSubSetGroupID = null;
				}
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->figureSubSetGroup) && ( ! isset($clientDataObj->updateClasses) || (in_array("FigureSetSubGroup", $clientDataObj->updateClasses))) && in_array("figureSubSetGroup", $clientDataObj->fieldsToUpdate) && ! isset($this->figureSubSetGroupIDJustCreated)) {
				(FigureSetSubGroup::fromDB($this->figureSubSetGroupID))->updateInDB($clientDataObj->figureSubSetGroup);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("ReleaseSet",
				array("name", "releaseDate", "figureSubSetGroupID"),
				array($this->name, $this->releaseDate, $this->figureSubSetGroupID))->
			where(array("id" => $this->id)));
		
		// Update 1-N Links
		if (isset($clientDataObj->cards) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cards as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = Card::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->releaseSet = $this;
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
			delete("ReleaseSet")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getFigureSubSetGroup() {
		if ($this->figureSubSetGroupID != null) {
			if ( ! property_exists($this, "figureSubSetGroup")) {
				$this->figureSubSetGroup = FigureSetSubGroup::fromDB($this->figureSubSetGroupID);
			}
			return $this->figureSubSetGroup;
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
