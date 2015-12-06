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
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		
		$refNum = isset($_SESSION['id']) ? Refer::gerRefNumber() : 0;
		$refBonus = isset($_SESSION['id']) ? Refer::getRefBonus() : 0;
		require_once ROOT.'/'.Config::VIEW.'refer/index.php';
		return true;
	}
}
