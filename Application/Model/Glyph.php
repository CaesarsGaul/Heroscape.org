<?php

class Glyph extends HS_DatabaseObject {
	protected $id; // Int
	protected $name; // String
	protected $abbreviation; // String
	protected $summary; // String
	protected $description; // String
	protected $imageUrl; // Int
	protected $powerGlyph; // Boolean
	protected $temporaryGlyph; // Boolean
	protected $vcGlyph; // Boolean
	protected $authorID; // Int

	/* Static 'Constructors' */
	
	public static function fromDB($id, $subdomain = null) {
		global $OBJECT_MAP;
		if ( ! isset($OBJECT_MAP["Glyph"])) {
			$OBJECT_MAP["Glyph"] = array();
		}
		$obj = null;
		if (isset($OBJECT_MAP["Glyph"][$id])) {
			$obj = $OBJECT_MAP["Glyph"][$id];
		} else {
			$obj = parent::fromDBHelper(new self($subdomain), array("id" => $id));
			$OBJECT_MAP["Glyph"][$id] = $obj;
		}
		return $obj;
	}

	public static function create($clientDataObj, $subdomain=null) {
		$dbObj = self::dbConnection($subdomain);
		
		if ( ! self::userCanCreate($clientDataObj)) {
			return null;
		}
		
		
		
		if (isset($clientDataObj->author) &&
				! isset($clientDataObj->author->id)) {
			$clientDataObj->author = User::create($clientDataObj->author);
		}
		
		$id = $dbObj->dbInsert((new MySQLBuilder())->
			insert("Glyph",
				array("name", "abbreviation", "summary", "description", "imageUrl", "powerGlyph", "temporaryGlyph", "vcGlyph", "authorID"),
				array($clientDataObj->name,
					$clientDataObj->abbreviation,
					$clientDataObj->summary,
					$clientDataObj->description,
					$clientDataObj->imageUrl,
					isset($clientDataObj->powerGlyph) && $clientDataObj-> powerGlyph ? true : false,
					isset($clientDataObj->temporaryGlyph) && $clientDataObj-> temporaryGlyph ? true : false,
					isset($clientDataObj->vcGlyph) && $clientDataObj-> vcGlyph ? true : false,
					isset($clientDataObj->author) 
						? $clientDataObj->author->id
						: null)));
		
		$dbObj = self::fromDB($id);
		
		if (isset($clientDataObj->tags)) {
			foreach ($clientDataObj->tags as $tempClientDataObj) {
				GlyphTagLink::create(array(
					"glyph" => $dbObj,
					"tag" => GlyphTag::fromDB($tempClientDataObj->id)));
			}
		}
		$dbObj->createInitialLinks($clientDataObj);
		return $dbObj;
	}

	protected function createInitialLinks($clientDataObj) {
		// Create 1-N Links
		if (isset($clientDataObj->gameMapGlyphs)) {
			foreach ($clientDataObj->gameMapGlyphs as $clientLinkObj) {
				$clientLinkObj->glyph = $this;
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
			$whereArray["{$prefix}Glyph.id"] = $whereData["id"];
		}
		else {
			if (isset($whereData["name"])) {
				$whereArray["{$prefix}Glyph.name"] = $whereData["name"];
			}
			if (isset($whereData["abbreviation"])) {
				$whereArray["{$prefix}Glyph.abbreviation"] = $whereData["abbreviation"];
			}
			if (isset($whereData["summary"])) {
				$whereArray["{$prefix}Glyph.summary"] = $whereData["summary"];
			}
			if (isset($whereData["description"])) {
				$whereArray["{$prefix}Glyph.description"] = $whereData["description"];
			}
			if (isset($whereData["imageUrl"])) {
				$whereArray["{$prefix}Glyph.imageUrl"] = $whereData["imageUrl"];
			}
			if (isset($whereData["powerGlyph"])) {
				$whereArray["{$prefix}Glyph.powerGlyph"] = $whereData["powerGlyph"];
			}
			if (isset($whereData["temporaryGlyph"])) {
				$whereArray["{$prefix}Glyph.temporaryGlyph"] = $whereData["temporaryGlyph"];
			}
			if (isset($whereData["vcGlyph"])) {
				$whereArray["{$prefix}Glyph.vcGlyph"] = $whereData["vcGlyph"];
			}
			if (array_key_exists("author", $whereData)) {
				if (isset($whereData["author"]->id)) {
					$whereArray["{$prefix}Glyph.authorID"] = $whereData["author"]->id;
				} else if ($whereData["author"] == null) {
					$whereArray["{$prefix}Glyph.authorID"] = null;
				}
			}
		}
		
		if (isset($whereData["author"])) {
			$whereArray = array_merge($whereArray, User::createWhereArray($whereData["author"], "{$prefix}Glyph_authorID_"));
		}
		
		if (isset($whereData["id"])) {
			$whereArray = array_merge($whereArray, GlyphTag::createWhereArray($whereData["id"], "{$prefix}Glyph_id_GlyphTagLink_tagID_"));
		}
		
		return $whereArray;
	}

	// @DoNotUpdate
	public static function getOrderBy() {
		return array("Glyph.name" => "ASC");
	}

	public static function getPrimaryKey() {
		return "id";
	}

	public static function getNToMLinkClasses() {
		return array("GlyphTagLink" => "glyphID");
	}

	public static function getNToMLinkClassesWithType() {
		return array("GlyphTagLink" => "GlyphTag");
	}

	public static function getNToMLinkClassesWithJSVariableName() {
		return array("GlyphTagLink" => "tags");
	}

	public static function getNTo1LinkClasses() {
		return array("GameMapGlyph" => "glyphID");
	}

	public static function getForeignKeys() {
		return array("authorID" => "User");
	}

	public static function getColumnNames() {
		return array("id", "name", "abbreviation", "summary", "description", "imageUrl", "powerGlyph", "temporaryGlyph", "vcGlyph", "authorID");
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
		if (GameMapGlyph::countEntries(array("GameMapGlyph.glyphID" => $this->id)) > 0) {
			return "Unable to delete Glyph because one or more Game Map Glyph is dependent on it.";
		}
		
		// N-M Links
		GlyphTagLink::deleteEntries(GlyphTagLink::fetch(array("glyph" => $this)));
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
			if (isset($clientDataObj->abbreviation)) {
				$this->abbreviation = $clientDataObj->abbreviation;
			}
			if (isset($clientDataObj->summary)) {
				$this->summary = $clientDataObj->summary;
			}
			if (isset($clientDataObj->description)) {
				$this->description = $clientDataObj->description;
			}
			if (property_exists($clientDataObj, "imageUrl")) {
				$this->imageUrl = $clientDataObj->imageUrl;
			}
			if (isset($clientDataObj->powerGlyph)) {
				$this->powerGlyph = $clientDataObj->powerGlyph;
			}
			if (isset($clientDataObj->temporaryGlyph)) {
				$this->temporaryGlyph = $clientDataObj->temporaryGlyph;
			}
			if (isset($clientDataObj->vcGlyph)) {
				$this->vcGlyph = $clientDataObj->vcGlyph;
			}
			if (property_exists($clientDataObj, "author")) {
				if (isset($clientDataObj->author)) {
					if (isset($clientDataObj->author->id) && $clientDataObj->author->id > 0) {
						$this->authorID = $clientDataObj->author->id;
					} else {
						$this->authorID = (User::create($clientDataObj->author))->id;
						$this->authorIDJustCreated = true;
					}
				} else {
					$this->authorID = null;
				}
			}
		}
		
		// Update Foreign Key Columns
		if ( ! isset($clientDataObj->updateDepth) || $clientDataObj->updateDepth > 0) {
			if (isset($clientDataObj->author) && ( ! isset($clientDataObj->updateClasses) || (in_array("User", $clientDataObj->updateClasses))) && in_array("author", $clientDataObj->fieldsToUpdate) && ! isset($this->authorIDJustCreated)) {
				(User::fromDB($this->authorID))->updateInDB($clientDataObj->author);
			}
		}
		
		$this->dbUpdate((new MySQLBuilder())->
			update("Glyph",
				array("name", "abbreviation", "summary", "description", "imageUrl", "powerGlyph", "temporaryGlyph", "vcGlyph", "authorID"),
				array($this->name, $this->abbreviation, $this->summary, $this->description, $this->imageUrl, $this->powerGlyph, $this->temporaryGlyph, $this->vcGlyph, $this->authorID))->
			where(array("id" => $this->id)));
		
		if ((isset($clientDataObj->updateNtoMLinks) || (isset($clientDataObj->joins, $clientDataObj->joins->{'GlyphTagLink.glyphID'}))) && in_array("tags", $clientDataObj->linksToUpdate)) {
			$links = GlyphTagLink::fetch(array("glyph" => $this));
			$oldObjs = array();
			foreach ($links as $link) {
				$oldObjs[] = $link->getTag();
			}
			$newObjs = array();
			foreach ($clientDataObj->tags as $clientLinkObj) {
				if (is_object($clientLinkObj) && isset($clientLinkObj->id) && $clientLinkObj->id > 0) {
					$newObjs[] = GlyphTag::fromDB($clientLinkObj->id);
				}
			}
			subtractOverlap($newObjs, $oldObjs, array("id"));
			foreach ($newObjs as $newObj) {
				GlyphTagLink::create(array("tag" => $newObj, "glyph" => $this));
			}
			foreach ($oldObjs as $oldObj) {
				(GlyphTagLink::fromDB(array("tag" => $oldObj, "glyph" => $this)))->deleteInDB();
			}
		}
		
		// Update 1-N Links
		if (isset($clientDataObj->gameMapGlyphs) &&
				isset($clientDataObj->updateNto1) && $clientDataObj->updateNto1) {
			foreach ($clientDataObj->gameMapGlyphs as $clientLinkObj) {
				if (isset($clientLinkObj->id)) {
					$linkObj = GameMapGlyph::fromDB($clientLinkObj->id);
					$linkObj->updateInDB($clientLinkObj);
				} else {
					$clientLinkObj->glyph = $this;
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
			delete("Glyph")->
			where(array("id" => $this->id)));
		
		return "";
	}

	/* Getters */
	
	public function getAuthor() {
		if ($this->authorID != null) {
			if ( ! property_exists($this, "author")) {
				$this->author = User::fromDB($this->authorID);
			}
			return $this->author;
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
