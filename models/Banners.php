<?php
defined('BIT') or die;

class Banners
{
	/**
	 *  @brief Метод для получения данных из таблицы banners
	 *
	 * 	@param string $order Принимает строку названия типа сортировки
	 *  @return array Вернет массив случайных значений банеров
	 */
	public static function getBannersOnSite($order)
	{
		$db = DB::getDB();
		$listBanners = $db->select(['id','title','descr'], 'banners', ['publish'=>'='], $order, Config::NUM_BANNERS, 1);
		return $listBanners;
	}

	/**
	 *  @brief Метод для получения данных из таблицы banners
	 *
	 * 	@param string $order Принимает строку названия типа сортировки
	 *  @return array Вернет массив случайных значений банеров
	 */
	public static function getBannersOnAdmin($order)
	{
		$db = DB::getDB();
		$listBanners = $db->select(['id','title','descr', 'pubTime', 'publish'], 'banners', null, $order, Config::NUM_BANNERS, 1);
		return $listBanners;
	}

	/**
	 * @brief Статический метод для удалениия указанного баннера
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

}
