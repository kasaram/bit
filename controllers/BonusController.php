<?php

defined('BIT') or die;

class BonusController
{
	/*
	 * Отображает страницу Bonus
	*/
	public function actionIndex()
	{
		//проверяем есть ли бонусы у игрока или нет, если нет то переход на главную
		if(empty($_SESSION['bonus'])) header('Location: '.Config::ADDRESS);
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		//формируем массивы баннеров, реклымы и видео
		$listBanners = Banners::getBannersOnSite('rand');
		$reclameList = Reclama::getReclamaOnSite('rand');
		$videoList = Video::getVideoOnSite('rand');

		require_once ROOT.'/'.Config::VIEW.'bonus/index.php';
		return true;
	}
}
