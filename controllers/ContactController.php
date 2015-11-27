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
		$name = '';
		$email = '';
		$message = '';
		$result = false;

		if(isset($_POST['submit'])) {
			$name = Validate::cleanStr($_POST['name']);
			$email = Validate::cleanStr($_POST['email']);
			$message = Validate::cleanStr($_POST['message']);
			$errors = false;
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Incorrect e-mail!';
			}
			if($errors == false) {
				$result = Contact::sendMail($name, $email, $message);
			}
		}
		require_once ROOT.'/'.Config::VIEW.'contact/index.php';
		return true;
	}

}
