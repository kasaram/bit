<?php

defined('BIT') or die;

class FaqController
{
	/**
	 *	Отображает страницу FAQ
	*/
	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		require_once ROOT.'/'.Config::VIEW.'faq/index.php';
		return true;
	}
}
