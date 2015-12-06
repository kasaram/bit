<?php

defined('BIT') or die;

class Validate
{

	/**
	 * Статический метод, позволяющий проверить прошло ли время до следующей игры
	 * @param int $time Принимает число секунд до следующей игры
	 * @return bool Вернет булево значение в зависимости от того пройдена проверка или нет
	 */
	public static function checkPauseGame($time)
	{
		if (time() >= $time) return true;
		else return false;
	}

	/**
 	 *  Метод для проверки корректного ввода биткоина
 	 *
 	 * @param string Принимает строку биткоина
 	 * @return bool Вернет true если проверка пройдена и false если нет
	*/
	public static function checkBitcoin($bitcoin)
	{
		if($bitcoin['0'] === '1') return true;
		else return false;
	}

	/**
	 *   Метод для очистки строк
	 *
	 *  @param string $par Строка
	 *  @return string Вернет очищенную строку
	 */
	public static function cleanStr($par)
	{
		return trim(strip_tags($par));
	}

	/**
	 *   Метод для приведения числа к типу integer
	 *
	 *  @param int $par Число
	 *  @return int Вернет обработанное число
	 */
	public static function cleanInt($par)
	{
		return abs((int)$par);
	}

}
