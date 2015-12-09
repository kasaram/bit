<?php
defined('BIT') or die;

class Site
{

  /**
   * Статический метод для пересчета и установки новых значений данных игрока
   * @return int Вернет число временного выйгрыша
   */
  public static function setDataGame()
  {
    //если есть дневной бонус, то пересчитываем выигрыш за игру и складываем его с балансом
    if(!empty($_SESSION['dailyBonus'])) {
      $dailyBonus = floor(($_SESSION['claimAmount'] * $_SESSION['dailyBonus'])/100); 
      $gameBalance = $_SESSION['claimAmount'] + $dailyBonus;
    } else $gameBalance = $_SESSION['claimAmount'];
    //пересчитываем баланс и бонус
    $balance = $_SESSION['balance'] + $gameBalance;
    $bonus = $_SESSION['bonus'] + $_SESSION['bonusMinutes'];
    //записываем новые значения баланса и бонуса в бд
    $res = User::changeUser(['balance'=>$balance, 'bonus'=>$bonus], $_SESSION['id']);
    if(!empty($res)) {
      $_SESSION['balance'] = $balance;
      $_SESSION['bonus'] = $bonus;
      $_SESSION['claimAmount'] = 0;
      $_SESSION['bonusMinutes'] = 0;
      $_SESSION['claimAmountBefore'] = 0;
      $_SESSION['bonusMinutesBefore'] = 0;
    }
    return $gameBalance;
  }

  /**
   * Статический метод для получения баланса
   * @return int Вернет число баланса
   */
  public static function getBalance()
  {
    $balance = User::getUser('balance', $_SESSION['id']);
    return $balance['balance'];
  }

  /**
 	 * Статический метод позволяет зарегистрировать нового пользователя и вернуть его значения или вернуть значения существующего пользователя
   * @param string $bitcoin Принмает строку биткоина
 	 * @param string $ref Принмает строку для реферала(указан родительский биткоин)
 	 * @return array Вернет массив значений пользователя привязанного к указанному биткоину
	*/
  public static function login($bitcoin, $ref)
  { 
    //проверяем зарегистрирован ли биткоин, если нет то регим и получаем его id, так же устанавливаем ему подарочный бонус
    if(empty(@User::getUserId($bitcoin))) {
      $parentId = !empty($ref) ? User::getUserId($ref) : $ref;
      $result = User::setUser($bitcoin, $parentId, Config::DEF_BONUS);
      if(!empty($result)) $userId = User::getUserId($bitcoin);
    } else {
      $userId = User::getUserId($bitcoin);
    }
    $userData = User::getUser(['id', 'bitcoin', 'parentId', 'regDate', 'nextVisit', 'withdraw','balance','lastPayOut','lastDateOut', 'bonus', 'dailyBonus', 'pauseGame', 'pauseBonus'], $userId);
    return $userData;
  }

  /**
   * Статический метод для проверки и установки дневного бонуса
   * @return void
   */
  public static function changeDailyBonus()
  {
      //смотрит из базы первое ли посещение, если да то устанавливаем дату следующего посещения 
      if (empty($_SESSION['nextVisit'])) {
        $nextVisit = time() + 24*60*60; 
        self::setNextVisit($nextVisit);
      } 
      //проверяем следующий визит меньше текущего времени
      if ($_SESSION['nextVisit'] < time()) {
        $bon = true;
      }
      //если время прошло менее суток с момента записи в бд следующего визита и существует $bon, то увеличиваем дневной бонус и записываем его в бд и сессию
      if ((time() - $_SESSION['nextVisit']) <= 24*60*60 && isset($bon)) {
        if ($_SESSION['dailyBonus'] < Config::MAX_DAILY_BONUS) {
          $dailyBonus = $_SESSION['dailyBonus'] + Config::DAILY_BONUS;
          self::setDailyBonus($dailyBonus);
        }
      } 
      //если время прошло больше суток то обнуляем бонус и очищаем дату следующего визита
      if ((time() - $_SESSION['nextVisit']) >= 24*60*60) {
        self::setNextVisit(0);
        self::setDailyBonus(0);
      }
      //защита от многократного добавления бонусов, если cледующий визит меньше времени, то переписываем его
      if ($_SESSION['nextVisit'] < time() && !empty($_SESSION['nextVisit'])) {
        $nextVisit = $_SESSION['nextVisit'] + 24*60*60; 
        self::setNextVisit($nextVisit);
      }
  }

  /**
   * Закрытый статический метод для установки времени следующего посещения
   * @param int $time Принимает число секунд времени 
   * @return boll Вернет булево значение в зависимости от того удалось ли изменить время следующего посещения
   */
  private static function setNextVisit($time)
  {
    $userId = $_SESSION['id'];
    $res = User::changeUser(['nextVisit'=>$time], $userId);
    if(!empty($res)) {
      $_SESSION['nextVisit'] = $time;
    }
    return $res;
  }

  /**
   * Статический метод для установки дневного бонуса
   * @param int $num Принимает число дневного бонуса
   * @return boll Вернет булево значение в зависимости от того удалось ли установить дневной бонус
   */
  private static function setDailyBonus($num)
  {
    $userId = $_SESSION['id'];
    $res = User::changeUser(['dailyBonus'=>$num], $userId);
    if(!empty($res)) {
      $_SESSION['dailyBonus'] = $num;
    }
    return $res;
  }

}
