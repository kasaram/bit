<?php
defined('BIT') or die;

class Bonus
{

	/**
	 *  @brief Статический метод для получения данных из таблицы reclame
	 *
	 *  @return array Вернет массив данных рекламы
	 */
	public static function getReclame()
	{
		$db = DB::getDB();
		$reclameData = $db->select('descr', 'reclame', null, 'rand', Config::NUM_RECLAME);
		return $reclameData;
	}

	/**
 	 * @brief Статический метод для получения видео
 	 *
 	 * @return array Вернет массив данных видео
	*/
	public static function getVideo()
	{
		$db = DB::getDB();
		$videoData = $db->select('descr', 'videos', null, 'rand', Config::NUM_VIDEO);
		return $videoData;
	}
}
