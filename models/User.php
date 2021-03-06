<?php
defined('BIT') or die;

class User
{
	/**
	 *  Статический метод для получения данных из таблицы пльзователей
	 *	@param	string|array $data Указываем строку или массив полей, данные для которых необходимо извлечь
	 *	@param	string|int $userId Указываем id пользователя, данные которого нужно получить
	 *  @return array Вернет массив данных указанного юзера
	 */
	public static function getUser($data, $userId)
	{
		$db = DB::getDB();
		$userData = $db->select($data, 'users', ['id'=>'='], null, null, $userId);
		return $userData[0];
	}

	/**
	 * Статический метод, который вернет определенные данные всех пользователей(для админки)
	 * @return type Вернет массив пользователей
	 */
	public static function getUsersAll()
	{
		$db = DB::getDB();
		$listUsers = $db->select(['id', 'bitcoin', 'balance', 'regDate', 'lastDateOut'], 'users', [['withdraw'=>'=', 'balance'=>'>'],['AND']], ['DESC', 'balance'], null, ['1', Config::SUM_AMOUNT]);
		return $listUsers;
	}

	/**
	 * Статический метод для создания нового пользователя
	 * @param string $bitcoin Принимает строку биткоина
	 * @param string|int $bous Принимает строку бонуса
	 * @param string|int $parentId Принимает число для реферала(родительский id)
	 * @return bool Вернет булево значение в зависимости записаны ли данные БД
	*/
	public static function setUser($bitcoin, $parentId, $bonus = '0')
	{
			$db = DB::getDB();
			$result = $db->insert('users', ['bitcoin', 'parentId', 'regDate', 'bonus'], [$bitcoin, $parentId, time(), $bonus]);
			return $result;
	}

	/**
 	 * Статический метод для изменения данных у пользователя
 	 * @param array $data Массив данных, которые нужно обновить
 	 * @param string|int $userId Индекнтификатор пользователя, данные которого нужно изменить
 	 * @return bool Вернет истину если все удачно обновлено или ложь если не удалось обновить
	*/
	public static function changeUser($data, $userId)
	{
		$params = array_values($data);
		array_push($params, $userId);
		$updateData = array_keys($data);
		$db = DB::getDB();
		return $db->update('users', $updateData, ['id'=>'='], $params);
	}

	/**
 	 * Статический метод для получения id юзера из БД пользователей
 	 * @param string $bitcoin Принимает строку биткоина
 	 * @return array|bool Вернет массив содержащий id юзера или ложь
	*/
  public static function getUserId($bitcoin)
  {
    $db = DB::getDb();
    $result = $db->select('id','users', ['bitcoin'=>'='], null, null, $bitcoin);
    return $result['0']['id'];
  }

	/**
 	 * Статический метод для записи данных о юзере в сессию
 	 * @param array $userData Принимает массив данных о юзере
 	 * @return bool Вернет истину если удалось записать сессию или ложь в обратном случае
	*/
	public static function sessionUser($userData)
	{
		if(is_array($userData)) {
			foreach($userData as $k=>$v) {
				$_SESSION[$k] = $v;
			}
			return true;
		} else return false;
	}
}