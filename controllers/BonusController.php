<?php

defined('BIT') or die;

class BonusController
{
	/*
	 * Отображает страницу Bonus
	*/
	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		$reclameList = Reclama::getReclamaOnSite('rand');
		$videoList = Video::getVideoOnSite('rand');

		require_once ROOT.'/'.Config::VIEW.'bonus/index.php';
		return true;
	}
}
