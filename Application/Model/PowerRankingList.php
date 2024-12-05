<?php

class PowerRankingList extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $authorID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["PowerRankingList"])) {
			$OBJECT_MAP["PowerRankingList"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["PowerRankingList"][$id])) {
			$obj = $OBJECT_MAP["PowerRankingList"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["PowerRankingList"][$id] = $obj;
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
			return "A Power Ranking List already exists with that id - you cannot have duplicate entries.";
		}
		
		if ( ! isset($clientDataObj->author->id)) {
			$clientDataObj->author = User::create($clientDataObj->author);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("PowerRankingList",
				array("name", "authorID"),
				array($clientDataObj->name,
					$clientDataObj->author->id)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->figureSetSubGroups)) {
			foreach ($clientDataObj->figureSetSubGroups as $tempClientDataObj) {
				PowerRankingListFigureSetSubGroupLink::create(array(
					"powerRankingList" => $dbObj,
					"figureSetSubGroup" => FigureSetSubGroup::fromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->cardPowerRankings)) {
			foreach ($clientDataObj->cardPowerRankings as $clientLinkObj) {
				$clientLinkObj->powerRankingList = $this;
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
			$whereArray["{$prefix}PowerRankingList.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}PowerRankingList.name"] = $whereData["name"];
			}
			if (array_key_exists("author", $whereData)) {
				if (isset($whereData["author"]->id)) {
					$whereArray["{$prefix}PowerRankingList.authorID"] = $whereData["author"]->id;
				} else if ($whereData["author"] == null) {
					$whereArray["{$prefix}PowerRankingList.authorID"] = null;
				}
			}
		}
		
		if (isset($whereData["author"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["author"], "{$prefix}PowerRankingList_authorID_"));
		}
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, FigureSetSubGroup::createWhereArray($whereData["id"], "{$prefix}PowerRankingList_id_PowerRankingListFigureSetSubGroupLink_figureSetSubGroupID_"));
		}
		
		return $whereArray;
	}

	public static function getOrderBy() {
	// TODO: fill in this array with column(s) to order results by like this: array("PowerRankingList.name" => "ASC")
		return array();
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("PowerRankingListFigureSetSubGroupLink" => "powerRankingListID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("PowerRankingListFigureSetSubGroupLink" => "FigureSetSubGroup");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("PowerRankingListFigureSetSubGroupLink" => "figureSetSubGroups");
	}

	public static function getNTo1LinkClasses() {
		return array("CardPowerRanking" => "powerRankingListID");
	}

	public static function getForeignKeys() {
		return array("authorID" => "User");
	}

	public static function getColumnNames() {
		return array("id", "name", "authorID");
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
		if (CardPowerRanking::countEntries(array("CardPowerRanking.powerRankingListID" => $this->id)) > 0) {
			return "Unable to delete Power Ranking List because one or more Card Power Ranking is dependent on it.";
		}
		
		// N-M Links
		PowerRankingListFigureSetSubGroupLink::deleteEntries(PowerRankingListFigureSetSubGroupLink::fetch(array("powerRankingList" => $this)));
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
			if (isset($clientDataObj->author, $clientDataObj->author->id) &&
					$clientDataObj->author->id > 0) {
					$this->authorID = $clientDataObj->author->id;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->author) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("author", $clientDataObj->fieldsToUpdate) && ! isset($this->authorIDJustCreated)) {
				(User::fromDB($this->authorID))->updateInDB($clientDataObj->author);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("PowerRankingList",
				array("name", "authorID"),
				array($this->name, $this->authorID))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'PowerRankingListFigureSetSubGroupLink.powerRankingListID'}))) && in_array("figureSetSubGroups", $clientDataObj->linksToUpdate)) {
			$links = PowerRankingListFigureSetSubGroupLink::fetch(array("powerRankingList" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getFigureSetSubGroup();
			}
			$newObjs = array();
			foreach ($clientDataObj->figureSetSubGroups as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = FigureSetSubGroup::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				PowerRankingListFigureSetSubGroupLink::create(array("figureSetSubGroup" => $newObj, "powerRankingList" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(PowerRankingListFigureSetSubGroupLink::fromDB(array("figureSetSubGroup" => $oldObj, "powerRankingList" => $this)))->deleteInDB();
			}
		}
		
		// Update 1-N Links
		if (isset($clientDataObj->cardPowerRankings) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->cardPowerRankings as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = CardPowerRanking::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->powerRankingList = $this;
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
			delete("PowerRankingList")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getAuthor() {
		if ( ! property_exists($this, "author")) {
			$this->author = User::fromDB($this->authorID);
		}
		return $this->author;
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
