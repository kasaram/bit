<?php

defined('BIT') or die;

class ContactController
{

	/**
 	 * Отоюражает и обрабатывает страницу Contact
	 */
	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		$msg = false;
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		//если пришла форма, то обрабатываем ее и отправляем письмо
		if(isset($_POST['submit'])) {
			unset($_POST['submit']);
			$msg = Contact::sendMail($_POST);
		}
		require_once ROOT.'/'.Config::VIEW.'contact/index.php';
		return true;
	}

}
