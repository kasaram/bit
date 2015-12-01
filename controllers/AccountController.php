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
