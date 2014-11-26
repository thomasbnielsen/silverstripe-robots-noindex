<?php
 
class RobotsNoindexSiteConfig extends DataExtension {
     
    private static $db = array(
		'IndexCode' => "Enum('noindex, index')"
    );
	
    public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Robots", new DropdownField("IndexCode", _t("RobotsNoindex.INDEXDD_LABEL","Index by search engines?"), $this->owner->dbObject('IndexCode')->enumValues()));
    }
}