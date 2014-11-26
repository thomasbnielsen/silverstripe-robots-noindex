<?php

class InfoBox_index implements InfoBox {

	public function show() {
		return SiteConfig::current_site_config()->IndexCode == "noindex";
	}

	public function message() {
		return _t("RobotsNoindex.NO_INDEX_WARNING", "No indexing!");
	}

	public function severity() {
		return 1;
	}

	public function link() {
		return 'admin/settings';
	}

}
