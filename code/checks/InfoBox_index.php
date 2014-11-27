<?php

class InfoBox_index implements InfoBox {

	public function show() {
		return Director::isDev() OR Director::isTest() ? 1 : 0;
	}

	public function message() {
		return _t("RobotsNoindex.NO_INDEX_WARNING", "No indexing!");
	}

	public function severity() {
		return 1;
	}

	public function link() {
		return false;
	}

}
