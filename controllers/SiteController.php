<?php

defined('BIT') or die;

class SiteController
{
	/**
 	 * Отображает главную страницу сайта
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
		//проверяем истекло ли время до следующей игры и создаем новую игру
		if(isset($_SESSION['pauseGame']) && empty($_SESSION['numChance']) && !empty(Validate::checkPauseGame($_SESSION['pauseGame']))) {
			$dataGame = Games::loadGame();
			User::sessionUser($dataGame);
		}
		//задаем данные для боксов
		$dataBox = isset($_SESSION['dataBox']) ? $_SESSION['dataBox'] : Games::getDataBox('bag-opened', 'bag');

		require_once ROOT.'/'.Config::VIEW.'site/index.php';
		return true;
	}

	/**
	 * Осуществляет перевод временного выйгрыша денег и бонусов в постоянный баланс
	 */
	public function actionClaim()
	{
		//проверка капчи
		if(empty(Validate::checkCaptcha($_POST['captcha']))) $get = '?res=fail_captcha';
		//условия для перевода денег и бонуса с временного выйгрыша в баланс
		if((!empty($_SESSION['claimAmount']) || !empty($_SESSION['bonusMinutes'])) && (empty($_SESSION['numChance']) || $_SESSION['numChance'] == Config::NUM_CHANCE) && !isset($get)) {
			//установливаем новые значени бонуса, баланса и др. у игрока
			Site::setDataGame();
			//если игрок был зарегин по реф ссылке, то процент от его выйгрыша идет рефереру
			if (!empty($_SESSION['parentId'])) {
				Refer::setRefBonus($gameBalance);
			} 
			$get = '';
		}
		header('Location: '.Config::ADDRESS.$get);
	}

	/**
	 * Обработчик игр
	 * @param int $val Принимает число для формирования кликов произведенных игроком за одну игру
	 */
	public function actionGames($val)
	{
		if(session_status() !== PHP_SESSION_ACTIVE) session_start();
		//проверяем есть ли еще шансы и не кликали ли на один сундук повторно
		if ($_SESSION['numChance'] > 0 && !in_array($val, $_SESSION['clicksBox'])) {
			array_push($_SESSION['clicksBox'], $val);
			$_SESSION['numChance']--;
			$_SESSION['dataBox'] = Games::getDataBox('bag-opened', 'bag'); 
		}
		if(empty($_SESSION['numChance'])) {
			//получаем массив открытых данных бокса и указываем класс открытых боксов
			$_SESSION['dataBox'] = Games::showDataBox('bag-opened');
			//устанавливаем время до следующей игры и записываем это время в бд и в сессию 
			$time = time() + Config::PAUSE_GAME*60;
			Games::setPauseGame($time);
			$_SESSION['pauseGame'] = $time;
		}
		header('Location: '.Config::ADDRESS);
	}

	/**
	 *	Позволяет залогинеться или зарегистрироваться и сразу войти в личный кабине, при этом создастся игра
	*/
	public function actionLogin()
	{
		$res = '';
		if(isset($_POST['bitcoin']) && !empty(trim($_POST['bitcoin']))) {
			$bitcoin = Validate::cleanStr($_POST['bitcoin']);
			if(!Validate::checkBitcoin($bitcoin)) {
				$res = '?res=fail_bit';
			} else {
				if(session_status() !== PHP_SESSION_ACTIVE) session_start();
				//Проверяем наличие реферальной ссылки
				$ref = isset($_POST['ref']) ? Validate::cleanStr($_POST['ref']) : 0;
				//Устанавливаем если не установлены и получаем данные игрока
				$userDbData = Site::login($bitcoin, $ref);
				//проверяем осталось ли время до следующей игры, и если нет то загружаем игру
				if (!empty(Validate::checkPauseGame($userDbData['pauseGame']))) {
					$dataGame = Games::loadGame();
					//получаем массив данных из БД и суммируем к ним массив боксов
					$userData = array_merge($userDbData, $dataGame);
				} else $userData = $userDbData;
		    User::sessionUser($userData);
			}
		}
	  header('Location: '.Config::ADDRESS.$res);
	}

	/**
	 *	Выход из личного кабинета 
	*/
	public function actionLogout()
	{
		if(session_status() !== PHP_SESSION_ACTIVE) session_start();
		foreach ($_SESSION as $k=>$v) {
			if($k == 'adm_log' || $k == 'adm_pass') continue;
			else unset($_SESSION[$k]);
		}
		if (empty($_SESSION)) {
			setcookie(session_name(), '', 0);
			session_unset();
			session_destroy();
		}
		header('Location: '.Config::ADDRESS);
	}
}
