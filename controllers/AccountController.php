<?php

defined('BIT') or die;

class AccountController
{
	/*
	 * Отображает страницу Account
	*/
	public function actionIndex()
	{
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
			$res = !empty($result) ? 'sucBit' : 'failBit';
		}
		//ob_start();
		header('Location:'.Config::ADDRESS.'account/?'.$res);
		//ob_end_flush();
	}

	/*
	 * Принимает параметры изменения автоплатежа и возвращает на страницу Account
	*/
	public function actionWithdraw()
	{
		$with = isset($_POST['withdraw']) ? $_POST['withdraw'] : 'no';
		Account::changeWithdraw($with, $_SESSION['id']);
		header('Location:'.Config::ADDRESS.'account');
	}




}
