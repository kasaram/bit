<?php
defined('BIT') or die;

class Account
{
	/**
	 *  @brief Статический метод для изменения биткоина
	 *
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
			User::changeUser(['bitcoin'=>$bitcoin], $id);
			$userData = User::getUser('bitcoin', $id);
			return User::sessionUser($userData);
		}
	}
	/**
	 *  @brief Статический метод для изменения статуса автоплатежа
	 *
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
