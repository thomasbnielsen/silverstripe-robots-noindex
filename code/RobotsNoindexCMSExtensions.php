<?php
 
class RobotsNoindexCMSExtensions extends DataExtension {

	public function MetaTags(&$tags) {
		$tags .= '<meta name="robots" content="'.SiteConfig::current_site_config()->IndexCode.'" />';
		return $tags;
	}
	
}