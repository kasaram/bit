<?php
defined('BIT') or die;

class BonusController
{
	/*
	 * Отображает страницу Bonus
	*/
	public function actionIndex()
	{
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//проверяем если нет бонусов и временных денег, то перенаправим на главную
		if(empty($_SESSION['bonus']) && empty($_SESSION['amountBonus'])) {
			header('Location: '.Config::ADDRESS);
		}
		//проверяем если бонусов нет, но есть временные деньги у игрока, то перенаправляем на экшен Claim для автоматического перевода денег в баланс
		if(empty($_SESSION['bonus']) && !empty($_SESSION['amountBonus'])) {
			header('Location: '.Config::ADDRESS.'bonus/claim');
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		//устанавливаем временный выйгрыш в бонусной игре
		$amountBonus = isset($_SESSION['amountBonus']) ? $_SESSION['amountBonus'] : 0;
		//формируем массивы баннеров
		$listBanners = Banners::getBannersOnSite('rand');
		//получаем рекламу
		$reclameList = Reclama::getReclamaOnSite('rand');
		//формируем текст сообщения для окна баннеров
		//$text = time() < $_SESSION['pauseBonus'] ? "Please wait..." : 'Click on a banner and benefit from '.Config::AMOUNT_BONUS_1.' to '.Config::AMOUNT_BONUS_2.' '.Config::COIN;
		$text = time() < $_SESSION['pauseBonus'] ? "Please wait..." : '';
		//формируем первое видео и список последующих видео
		$videoList = Video::getVideoOnSite('rand');
		if(!empty($videoList)) {
			$video = $videoList[0];
			unset($videoList[0]);
			$playList = implode(',', $videoList);
		}
		//устанавливаем время до следующей игры
		$timeNextGame = time() < $_SESSION['pauseBonus'] ?  $_SESSION['pauseBonus'] - time() : Config::PAUSE_BONUS;
		//если установлено время до следующей игры, то запускаем таймер
		$start = time() < $_SESSION['pauseBonus'] ? '.start()' : '';
		

		require_once ROOT.'/'.Config::VIEW.'bonus/index.php';
		return true;
	}

	/**
	 * Устанавливает баланс в бонусной игре
	 */
	public function actionClaim() 
	{
		if(isset($_POST['captcha']) && empty(Validate::checkCaptcha($_POST['captcha']))) {
				$get = '/?res=fail_captcha';
		}
		if (!isset($get)) {
			Bonus::setBalance();
			$get = '';
		} 
		header('Location: '.Config::ADDRESS.'bonus'.$get);		
	}

	/**
	 * Запускает бонусную игру
	 */
	public function actionStart()
	{
		//если время до следующей игры еще не прошло, то выводим текущий временый баланс
		if (time() < $_SESSION['pauseBonus']) {
			echo $_SESSION['amountBonus'].' '.Config::COIN;
			exit;
		}
		if(isset($_GET['clickStart'])) {
			//устанавливаем время до следующей игры
			Bonus::setPauseBonus();
			//Устанавливаем новое значение бонуса
			Bonus::setBonus();
			//устанавливаем новое значение временного выйгрыша в бонусной игре и выводим его для js запроса
			echo Bonus::setAmountBonus().' '.Config::COIN;
		} else header('Location: '.Config::ADDRESS.'bonus');
		return true;
	}
}