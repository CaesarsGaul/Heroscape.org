<?php

class HeroscapeMapTag extends HS_DatabaseObject {
	protected $id; // Int
	protected $tag; // String

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["HeroscapeMapTag"])) {
			$OBJECT_MAP["HeroscapeMapTag"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["HeroscapeMapTag"][$id])) {
			$obj = $OBJECT_MAP["HeroscapeMapTag"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["HeroscapeMapTag"][$id] = $obj;
		}
		return $obj;
	}

	public static function fromDB_tag($tag, $subdomain = null) {
		return parent::fromDBHelper(new self($subdomain), array("tag" => $tag));
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		if (isset($clientDataObj->tag) && self::exists(array("tag" => $clientDataObj->tag))) {
			return "A Heroscape Map Tag already exists with that tag - you cannot have duplicate entries.";
		}
		
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("HeroscapeMapTag",
				array("tag"),
				array($clientDataObj->tag)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->maps)) {
			foreach ($clientDataObj->maps as $tempClientDataObj) {
				HeroscapeMapTagLink::create(array(
					"tag" => $dbObj,
					"map" => HeroscapeMap::fromDB($tempClientDataObj->id)));
			}
		}
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
			$whereArray["{$prefix}HeroscapeMapTag.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["tag"])) {
				$whereArray["{$prefix}HeroscapeMapTag.tag"] = $whereData["tag"];
			}
		}
		
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, HeroscapeMap::createWhereArray($whereData["id"], "{$prefix}HeroscapeMapTag_id_HeroscapeMapTagLink_mapID_"));
		}
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("HeroscapeMapTag.tag" => "ASC");
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("HeroscapeMapTagLink" => "tagID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("HeroscapeMapTagLink" => "HeroscapeMap");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("HeroscapeMapTagLink" => "maps");
	}

	public static function getNTo1LinkClasses() {
		return array();
	}

	public static function getForeignKeys() {
		return array();
	}

	public static function getColumnNames() {
		return array("id", "tag");
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
		HeroscapeMapTagLink::deleteEntries(HeroscapeMapTagLink::fetch(array("heroscapeMapTag" => $this)));
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
			if (isset($clientDataObj->tag)) {
				if (isset($clientDataObj->tag) && $this->tag != $clientDataObj->tag && self::exists(array("tag" => $clientDataObj->tag))) {
					return "A Heroscape Map Tag already exists with that tag - you cannot have duplicate entries.";
				}
				$this->tag = $clientDataObj->tag;
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("HeroscapeMapTag",
				array("tag"),
				array($this->tag))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'HeroscapeMapTagLink.tagID'}))) && in_array("maps", $clientDataObj->linksToUpdate)) {
			$links = HeroscapeMapTagLink::fetch(array("tag" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getMap();
			}
			$newObjs = array();
			foreach ($clientDataObj->maps as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = HeroscapeMap::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				HeroscapeMapTagLink::create(array("map" => $newObj, "tag" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(HeroscapeMapTagLink::fromDB(array("map" => $oldObj, "tag" => $this)))->deleteInDB();
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
			delete("HeroscapeMapTag")->
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
