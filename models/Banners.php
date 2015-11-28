<?php
defined('BIT') or die;

class Banners
{
	/**
	 *   Метод для получения данных из таблицы banners
	 *
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array Вернет массив случайных значений банеров
	 */
	public static function getBannersOnSite($order)
	{
		$db = DB::getDB();
		$listBanners = $db->select(['id','title','descr'], 'banners', ['publish'=>'='], $order, Config::NUM_BANNERS, 1);
		return $listBanners;
	}

	/**
	 *   Метод для получения данных из таблицы banners
	 *
	 * 	@param string|array $order Принимает строку или массив названия типа сортировки
	 *  @return array Вернет массив случайных значений банеров
	 */
	public static function getBannersOnAdmin($order)
	{
		$db = DB::getDB();
		$listBanners = $db->select(['id','title','descr', 'pubTime', 'publish'], 'banners', null, $order, Config::NUM_BANNERS, 1);
		return $listBanners;
	}

	/**
	 * Статический метод для добавления баннера 
	 * @param array|string $data Принимает поле или массив полей, значения которых нужно вставить в БД
	 * @param array|string $params Принимает начение или массив значений, которые нужно вставить в БД
	 * @return bool Вернет булево значение взависимости от того удалось ли вставить данные в БД
	 */
	public static function addBanner($data, $params)
	{
		$db = Db::getDB();
		return $db->insert('banners', $data, $params);
	}

	/**
	 *  Статический метод для удалениия указанного баннера
	 *
	 * @param string|int $bannerId Принимает строку или число в виде номера баннера, который нужно удалить
	 * @return void Вернет булево значение в зависимости от того удалось удалить баннер или нет
	*/
	public static function removeBanner($bannerId)
	{
		$id = Validate::cleanInt($bannerId);
		$db = DB::getDb();
		return $db->delete('banners', ['id'=>'='], $id);
	}

	/**
	 * Статический метод для обновления статуса баннера в админке
	 * @param string|int $id Принимает id баннера, статус которого нужно изменить
	 * @param string|int $publish Принимает значение статуса
	 * @return bool Вернет булево значени в зависимости от того удалось ли изменить статус
	 */
	public static function updateStatusBanner($id, $publish) 
	{
		$id = Validate::cleanInt($id);
		$params = [$publish, $id];		
		$db = DB::getDb();
		return $db->update('banners', 'publish', ['id'=>'='], $params);
	}

}
