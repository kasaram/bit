<?php
defined('BIT') or die;

class Contact
{
	
	/**
	 * Статический метод для отправки писем 
	 * @param string $name Принимает строку в виде имени отправителя письма 
	 * @param string $email Принимает строу в виде e-mail адреса
	 * @param string $message Принимает строку в виде сообщения от отправителя
	 * @return string Вернет строку содержащию сообщение об ошибке или успехе 
	 */
	public static function sendMail($name, $email, $message)
	{
		if(empty($name) || empty($message)) {
			$msg = 'fail_mail_field';
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = 'fail_mail';
		} else {
			$adminEmail = Config::ADM_EMAIL;
			$message = 'Имя: '.$name.'<br/>E-mail: '.$email.'<br/>Сообщение: '.$message;
			$subject = 'Сообщение с сайат '.Config::SITE_NAME;
			$subject = '=?unf-8?B?'.base64_encode($subject).'?=';
			$headers = 'Contet-type: text/html; charset=utf-8';
			$result = mail($adminEmail, $subject, $message);
			$msg = !empty($result) ? 'suc_mail_send' : 'fail_mail_send';
		}
		return $msg;
	}
}
