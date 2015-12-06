<?php

defined('BIT') or die;

class AccountController
{
	/*
	 * Отображает страницу Account
	*/
	public function actionIndex()
	{
		//проверяем залогинин игрок или нет, если нет то переход на главную
		if(!isset($_SESSION['id'])) header('Location: '.Config::ADDRESS); 
		//если существует дневной бонус то пересчитываем его
		if(isset($_SESSION['dailyBonus'])) {
			Site::changeDailyBonus();
		}
		//получаем баланс и бонус
		$balance = isset($_SESSION['id']) ? Site::getBalance() : 0;
		$bonus = isset($_SESSION['id']) ? $_SESSION['bonus'] : 0;
		//получаем данные последнего платежа для страницы акаунта из базы, а не из сессии, т.к. если админ произведет изменения, они не будут отображены в текущей сессии
		$lastPay = Account::getLastPay();
		//получаем баннеры
		$listBanners = Banners::getBannersOnSite('rand');
		require_once ROOT.'/'.Config::VIEW.'account/index.php';
		return true;
	}

	/*
	 * Принимает параметры изменения биткоина и возвращает на страницу Account
	*/
	public function actionBitcoin()
	{
		if(isset($_POST['submit']) && !empty(trim($_POST['bitcoin']))){
			$result = Account::changeBitcoin($_POST['bitcoin'], $_SESSION['id']);
			$res = !empty($result) ? 'suc_bit_change' : 'fail_bit_change';
		} else $res = 'fail_bit_change';
		header('Location:'.Config::ADDRESS.'account/?res='.$res);
	}

	/*
	 * Изменяет состояние автоплатежа и возвращает на страницу Account
	*/
	public function actionWithdraw()
	{
		$with = isset($_POST['withdraw']) ? '1' : '0';
		$result = Account::changeWithdraw($with, $_SESSION['id']);
		$res = !empty($result) ? 'suc_with_change' : 'fail_with_change';
		header('Location:'.Config::ADDRESS.'account/?res='.$res);
	}
}
