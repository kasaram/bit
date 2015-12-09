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
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		require_once ROOT.'/'.Config::VIEW.'faq/index.php';
		return true;
	}
}