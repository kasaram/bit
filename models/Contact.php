<?php
defined('BIT') or die;

class Contact
{
	
	/**
	 * Статический метод для отправки писем 
	 * @param array $post Принимает массив данных переданных с формы 
	 * @return string Вернет строку содержащию сообщение об ошибке или успехе 
	 */
	public static function sendMail($post)
	{
		//очищаем от лишнего и распаковываем массив переданных данных с формы
		$postData = Validate::cleanArr($post);
		extract($postData);
		//осуществляем проверки на корректное заполнение полей
		if (empty(Validate::checkCaptcha($captcha))) {
			$msg = 'fail_captcha';
		} elseif (empty($name) || empty($message)) {
			$msg = 'fail_mail_field';
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = 'fail_mail';
		} else {
			//формируем и отправляем письмо
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
