<?php
defined('BIT') or die;

class Account
{
	/**
	 * Статический метод для получения данных последнего платежа
	 * @return array Вернет массив содержащий данные последнего платежа
	 */
	public static function getLastPay()
	{
		$lastPay = User::getUser(['lastPayOut','lastDateOut'], $_SESSION['id']);
		return $lastPay;
	}

	/**
	 *  Статический метод для изменения биткоина
	 *	@param	string $bitcoin Принимает строку биткоина
	 *	@param	string|int $id Принимает строку или число индентификатора пользователя
	 *  @return string|bool Вернет строку ошибки или булево значение успеха изменения биткоина
	 */
	public static function changeBitcoin($bitcoin, $id)
	{
		$bitcoin = Validate::cleanStr($bitcoin);
		if (!Validate::checkBitcoin($bitcoin)) {
			return false;
			exit;
		}else {
			$result = User::changeUser(['bitcoin'=>$bitcoin], $id);
			if(!empty($result)){
				$userData = User::getUser('bitcoin', $id);
				User::sessionUser($userData);
			}
			return $result;
		}
	}
	
	/**
	 *  Статический метод для изменения статуса автоплатежа
	 *	@param	string $with Принимает строку,  в которой указан параметр изменения статуса автоплатежа
	 *	@param	string|int $id Принимает строку или число индентификатора пользователя
	 *  @return string|bool Вернет строку ошибки или булево значение успеха изменения статуса автоплатежа
	 */
	public static function changeWithdraw($with, $id)
	{
		$with = Validate::cleanStr($with);
		User::changeUser(['withdraw'=>$with], $id);
		$userData = User::getUser('withdraw', $id);
		return User::sessionUser($userData);
	}
}