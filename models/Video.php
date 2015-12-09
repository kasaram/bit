<?php
defined('BIT') or die;

class Video
{
	/**
	 *  Статический метод для получения видео для сайта 
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array|bool Вернет массив данных рекламы либо false
	 */
	public static function getVideoOnSite($order)
	{
		$db = DB::getDB();
		$videoAll = $db->select(['descr'], 'video', ['publish'=>'='], $order, null, 1);
		if(!empty($videoAll)){
			for($i = 0; $i<count($videoAll); $i++) {
				$videoList[] = $videoAll[$i]['descr'];
			}
		} else return false;
		return $videoList;
	}

	/**
	 * Статический метод для получения видео
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array Вернет массив случайных значений видео
	 */
	public static function getVideoOnAdmin($order)
	{
		$db = DB::getDB();
		$videoList = $db->select(['id','title','descr', 'pubTime', 'publish'], 'video', null, $order, null, 1);
		return $videoList;
	}

	/**
	 * Статический метод для добавления видео
	 * @param array|string $data Принимает поле или массив полей, значения которых нужно вставить в БД
	 * @param array|string $params Принимает начение или массив значений, которые нужно вставить в БД
	 * @return bool Вернет булево значение взависимости от того удалось ли вставить данные в БД
	 */
	public static function addVideo($data, $params)
	{
		$db = DB::getDB();
		return $db->insert('video', $data, $params);
	}

	/**
	 * Статический метод для удалениия указанного видео
	 * @param string|int $bannerId Принимает строку или число в виде номера видео, который нужно удалить
	 * @return void Вернет булево значение в зависимости от того удалось удалить видео или нет
	*/
	public static function removeVideo($id)
	{
		$id = Validate::cleanInt($id);
		$db = DB::getDb();
		return $db->delete('video', ['id'=>'='], $id);
	}

	/**
	 * Статический метод для обновления статуса видео в админке
	 * @param string|int $id Принимает id видео, статус которого нужно изменить
	 * @param string|int $publish Принимает значение статуса
	 * @return bool Вернет булево значени в зависимости от того удалось ли изменить статус
	 */
	public static function updateStatusVideo($id, $publish) 
	{
		$id = Validate::cleanInt($id);
		$params = [$publish, $id];		
		$db = DB::getDb();
		return $db->update('video', 'publish', ['id'=>'='], $params);
	}

}
