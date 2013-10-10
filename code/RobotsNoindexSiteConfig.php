<?php
 
class RobotsNoindexSiteConfig extends DataExtension {
     
    private static $db = array(
		'IndexCode' => "Enum('noindex, index')"
    );
 
	
    public function updateCMSFields(FieldList $fields) {			
		
		$fields->addFieldToTab("Root.Robots", new DropdownField("IndexCode", _t("RobotsNoindex.INDEXDD_LABEL","Index by search engines?"), $this->owner->dbObject('IndexCode')->enumValues()));
		
		if(Director::isDev()) {
			$fields->addFieldToTab("Root.Main", new LiteralField("IsDevWarning", 
				"<p class=\"message warning\">" . _t("RobotsNoindex.IS_DEV_WARNING", 
				"Warning: This website is running in DEV mode!")
				. "</p>"), "Title");
		}
		
		if($this->owner->IndexCode == "noindex") {
			$fields->addFieldToTab("Root.Main", new LiteralField("NoindexWarning", 
				"<p class=\"message warning\">" . _t("RobotsNoindex.NO_INDEX_WARNING", 
				"Warning: This website is set to NOINDEX and will not be indexed in searchengines!")
				. "</p>"), "Title");
		}		
    }
}