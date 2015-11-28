<?php
defined('BIT') or die;

class Site
{

  /**
 	 *  Статический метод позволяет зарегистрировать нового пользователя и вернуть его значения или вернуть значения существующего пользователя
 	 *
 	 * @param string Принмает строку биткоина
 	 * @return array Вернет массив значений пользователя привязанного к указанному биткоину
	*/
  public static function login($bitcoin)
  {
    if(empty(@User::getUserId($bitcoin))) {
      $result = User::setUser($bitcoin);
      if(!empty($result)) $userId = User::getUserId($bitcoin);
    } else {
      $userId = User::getUserId($bitcoin);
    }
    $userData = User::getUser(['id', 'bitcoin','regDate','withdraw','balance','lastPayOut','lastDateOut', 'timeBonus'], $userId);
    return $userData;
  }

}
