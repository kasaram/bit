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
		$reclameList = Bonus::getReclame();
		$videoList = Bonus::getVideo();

		require_once ROOT.'/'.Config::VIEW.'bonus/index.php';
		return true;
	}
}
