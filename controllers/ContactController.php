<?php

defined('BIT') or die;

class ContactController
{

	/**
 	 * Отоюражает страницу Contact
	 */
	public function actionIndex()
	{
		$listBanners = Banners::getBannersOnSite('rand');
		$msg = false;

		if(isset($_POST['submit'])) {
			$name = Validate::cleanStr($_POST['name']);
			$email = Validate::cleanStr($_POST['email']);
			$message = Validate::cleanStr($_POST['message']);
			$msg = Contact::sendMail($name, $email, $message);
		}
		require_once ROOT.'/'.Config::VIEW.'contact/index.php';
		return true;
	}

}
