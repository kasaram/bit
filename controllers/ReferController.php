<?php

defined('BIT') or die;

class ReferController
{

	/**
	 *	Отображает страницу Refer
	*/
	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		require_once ROOT.'/'.Config::VIEW.'refer/index.php';
		return true;
	}
}
