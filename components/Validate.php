<?php

defined('BIT') or die;

class Validate
{
	/**
 	 * @brief Метод для проверки корректного ввода биткоина
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
	 *  @brief Метод для очистки строк
	 *
	 *  @param string $par Строка
	 *  @return string Вернет очищенную строку
	 */
	public static function cleanStr($par)
	{
		return trim(strip_tags($par));
	}

	/**
	 *  @brief Метод для приведения числа к типу integer
	 *
	 *  @param int $par Число
	 *  @return int Вернет обработанное число
	 */
	public static function cleanInt($par)
	{
		return abs((int)$par);
	}

}
