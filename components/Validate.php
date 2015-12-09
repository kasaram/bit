<?php
defined('BIT') or die;

class Validate
{
	/**
	 * Статический метод для проверки правильного ввода капчи
	 * @param string $captcha Принимает строку капчи 
	 * @return type Вернет булево значение в зависимости от того, верно ли введена капча
	 */
	public static function checkCaptcha($captcha)
	{
		$captcha = self::cleanStr($captcha);
		if(!empty($captcha) && $_SESSION['captcha'] == strtoupper($captcha)) return true;
		else false;
	}

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
 	 *  Статический метод для проверки корректного ввода биткоина
 	 * @param string Принимает строку биткоина
 	 * @return bool Вернет true если проверка пройдена и false если нет
	*/
	public static function checkBitcoin($bitcoin)
	{
		if($bitcoin['0'] === '1') return true;
		else return false;
	}

	/**
	 * Статический метод для очистки значений массива от тегов и лишних пробелов
	 * @param array $arr Принимает массив, значения которого нужно очистить
	 * @return type Вернет массив с валидными значениями
	 */
	public static function cleanArr($arr) 
	{
		$arrData = array_map(function($v){return self::cleanStr($v);}, $arr);
		return $arrData;
	}

	/**
	 * 	Статический метод для очистки строк
	 *  @param string $par Строка
	 *  @return string Вернет очищенную строку
	 */
	public static function cleanStr($par)
	{
		return trim(strip_tags($par));
	}

	/**
	 *  Статический метод для приведения числа к типу integer
	 *  @param int $par Число
	 *  @return int Вернет обработанное число
	 */
	public static function cleanInt($par)
	{
		return abs((int)$par);
	}
}