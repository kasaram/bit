<?php
defined('BIT') or die;

class Reclama
{
	/**
	 *  Статический метод для получения рекламы для сайта 
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array Вернет массив данных рекламы
	 */
	public static function getReclamaOnSite($order)
	{
		$db = DB::getDB();
		$reclamaData = $db->select(['id','title','descr'], 'reclama', ['publish'=>'='], $order, Config::NUM_RECLAME, 1);
		return $reclamaData;
	}

	/**
	 *  Статический метод для получения рекламы для админки
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array Вернет массив случайных значений рекламы
	 */
	public static function getReclamaOnAdmin($order)
	{
		$db = DB::getDB();
		$reclamaData = $db->select(['id','title','descr', 'pubTime', 'publish'], 'reclama', null, $order, null, 1);
		return $reclamaData;
	}

	/**
	 * Статический метод для добавления рекламы
	 * @param array|string $data Принимает поле или массив полей, значения которых нужно вставить в БД
	 * @param array|string $params Принимает начение или массив значений, которые нужно вставить в БД
	 * @return bool Вернет булево значение взависимости от того удалось ли вставить данные в БД
	 */
	public static function addReclama($data, $params)
	{
		$db = Db::getDB();
		return $db->insert('reclama', $data, $params);
	}

	/**
	 * Статический метод для удалениия указанного реклама
	 * @param string|int $bannerId Принимает строку или число в виде номера рекламы, который нужно удалить
	 * @return void Вернет булево значение в зависимости от того удалось удалить рекламу или нет
	*/
	public static function removeReclama($id)
	{
		$id = Validate::cleanInt($id);
		$db = DB::getDb();
		return $db->delete('reclama', ['id'=>'='], $id);
	}

	/**
	 * Статический метод для обновления статуса рекламы в админке
	 * @param string|int $id Принимает id рекламы, статус которого нужно изменить
	 * @param string|int $publish Принимает значение статуса
	 * @return bool Вернет булево значени в зависимости от того удалось ли изменить статус
	 */
	public static function updateStatusReclama($id, $publish) 
	{
		$id = Validate::cleanInt($id);
		$params = [$publish, $id];		
		$db = DB::getDb();
		return $db->update('reclama', 'publish', ['id'=>'='], $params);
	}

}
