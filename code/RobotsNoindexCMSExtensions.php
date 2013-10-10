<?php
 
class RobotsNoindexCMSExtensions extends DataExtension {
	 
    public function updateCMSFields(FieldList $fields) {
	
		if(Director::isDev()) {
			$fields->addFieldToTab("Root.Main", new LiteralField("IsDevWarning", 
				"<p class=\"message warning\">" . _t("RobotsNoindex.IS_DEV_WARNING", 
				"Warning: This website is running in DEV mode!")
				. "</p>"), "Title");
		}
					
		if(SiteConfig::current_site_config()->IndexCode == "noindex") {
			$fields->addFieldToTab("Root.Main", new LiteralField("NoindexWarning", 
				"<p class=\"message warning\">" . _t("RobotsNoindex.NO_INDEX_WARNING", 
				"Warning: This website is set to NOINDEX and will not be indexed in searchengines!")
				. "</p>"), "Title");
		}		
		
	}
	
	public function MetaTags(&$tags) {
		$tags .= '<meta name="robots" content="'.SiteConfig::current_site_config()->IndexCode.'" />';
		return $tags;
	}
	
}