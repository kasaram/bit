<?php
defined('BIT') or die;

class Bonus
{
	/**
	 * Статический метод для установки баланса в бонусной игру
	 * @return bool Вернет булево значение в зависимости от того удалось ли установить новй баланс
	 */
	public static function setBalance()
	{
		$oldBalance = Site::getBalance();
		$balance = $oldBalance + $_SESSION['amountBonus'];
		$_SESSION['amountBonus'] = 0;
		return User::changeUser(['balance'=>$balance], $_SESSION['id']);
	}
	
	/**
	 * Статический метод устанавливает временный выйгрыш в бонусной игре
	 * @return int Вернет число выйгранных денег
	 */
	public static function setAmountBonus()
	{
		$arrAmountBonus = [Config::AMOUNT_BONUS_1, Config::AMOUNT_BONUS_2];
		$i = mt_rand(0,1);
		$amountBonus = $arrAmountBonus[$i];
		$_SESSION['amountBonus'] = isset($_SESSION['amountBonus']) ? $_SESSION['amountBonus'] + $amountBonus : $amountBonus;
		return $_SESSION['amountBonus'];
	}

	/**
	 * Статический метод утсанавливает время до следующей игры
	 * @return bool Вернет булево значени в зависимости от того удалось ли установить время
	 */
	public static function setPauseBonus()
	{
		$timeNextGame = time() + Config::PAUSE_BONUS * 60;
		$_SESSION['pauseBonus'] = $timeNextGame;
		return User::changeUser(['pauseBonus'=>$timeNextGame], $_SESSION['id']);
	}

	/**
	 * Статический метод для установки бонуса
	 * @return bool Вернет булево значение в зависимости от того удалось ли установить бонус 
	 */
	public static function setBonus()
	{
		$_SESSION['bonus'] -= Config::PAUSE_BONUS;
		return User::changeUser(['bonus'=>$_SESSION['bonus']], $_SESSION['id']);
	}
}
