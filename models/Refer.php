<?php
defined('BIT') or die;

class Refer
{

	/**
	 * Статический метод для получения количества рефералов
	 * @return int Вернет число рефералов
	 */
	public static function gerRefNumber()
	{
		$db = DB::getDB();
		$refNum = $db->query("SELECT COUNT(id) as 'refNum' FROM asdf_users WHERE `parentId` = ?", $_SESSION['id']);
		return $refNum[0]['refNum'];
	}

	/**
	 * Статический метод для получения реферального бонуса
	 * @return int Вернет число реферальных бонусов
	 */
	public static function getRefBonus()
	{
		$refBonus = User::getUser('refBonus',  $_SESSION['id']);
		return $refBonus['refBonus'];
	}

	 /**
   * Статический метод для подсчета и установки реферального бонуса и нового баланса у родительского реферера
   * @param int $gameBalance Принимает число выйгрыша за одну игру реферала
   * @return bool Вернет булево значение в зависимости от того, получилось ли изменить значение реферального бонуса у реферера
   */
  public static function setRefBonus($gameBalance)
  {
    $userId = $_SESSION['parentId'];
    $oldRefBonus = User::getUser(['balance', 'refBonus'], $userId);
    if(isset($oldRefBonus)) {
      $refBalance = floor(($gameBalance*Config::REF_COMMISSION)/100);
      $balance = $oldRefBonus['balance'] + $refBalance;
      $refBonus = $oldRefBonus['refBonus'] + $refBalance;
      return User::changeUser(['balance'=>$balance, 'refBonus'=>$refBonus], $userId);
    }
  }

}
