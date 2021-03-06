<?php
defined('BIT') or die;

class Format
{
	/**
 	 * Статический метод для установки денежного формата
 	 * @param string|int Получаем строку или целое число
 	 * @return string Вернет строку в установленном формате
	*/
	public static function coinFormat($num)
	{
		return number_format($num, 0, '', ' ');
	}

	/**
 	 * Статический метод для установки формата даты на сайте
 	 * @param sring|int Принимает строку или число милисекунд
 	 * @return string Вернет дату в виде строки
	*/
	public static function dateFormat($date)
	{
		return date('Y.m.d', $date);
	}
	/**
	 * Статический метод для установки формата даты в админке
	 * @param sring|int Принимает строку или число милисекунд
	 * @return string Вернет дату в виде строки
	*/
	public static function adminDate($date)
	{
		return date('d.m.Y', $date);
	}
}