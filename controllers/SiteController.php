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
		require_once ROOT.'/'.Config::VIEW.'site/index.php';
		return true;
	}

	/**
	 *	Позволяет залогинеться или зарегистрироваться и сразу войти в личный кабинет
	*/
	public function actionLogin()
	{
		$error = '';
		if(isset($_POST['submit']) && !empty(trim($_POST['bitcoin']))) {
			$bitcoin = Validate::cleanStr($_POST['bitcoin']);
			if(!Validate::checkBitcoin($bitcoin)) {
				$error = '?error';
			} else {
				$userData = Site::login($bitcoin);
				ob_start();
				session_start();
		    User::sessionUser($userData);
			}
		}
	  header('Location: /'.$error);
		ob_end_flush();
	}

	/**
	 *	Выход из личного кабинета
	*/
	public function actionLogout()
	{
		setcookie(session_name(), '', 0);
		session_unset();
		session_destroy();
		header('Location: /');
	}
}
