<?php
defined('BIT') or die;

class Contact
{
	/**
	 *   Метод отправки писем
	 *
	 *  @return bool Вернет true  если письмо отправиться или  false если не отправиться
	 */
	public static function sendMail($name, $email, $message)
	{
		$adminEmail = Config::ADM_EMAIL;
		$message = 'Имя: '.$name.'<br/>E-mail: '.$email.'<br/>Сообщение: '.$message;
		$subject = 'Сообщение с сайат '.Config::SITE_NAME;
		$subject = '=?unf-8?B?'.base64_encode($subject).'?=';
		$headers = 'Contet-type: text/html; charset=utf-8';
		return mail($adminEmail, $subject, $message);
	}
}
