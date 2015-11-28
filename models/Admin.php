<?php
defined('BIT') or die;

class Admin
{

	/**
 	 *  Статический метод, который сохраняет новые конфигурации в файл
 	 *
 	 * @param array $post Принимает массив данных новых конфигураций
 	 * @param bool|null Принимает булево значение, если истина то установит значения по умолчанию
 	 * @return bool Вернет булево значени в зависимости от того удалось ли переписать конфигурационный файл
	*/
	public static function saveConfig($post, $default=null)
	{
		//удаляем последний элемент массива - ключ и значение кнопки отправки
		array_pop($post);
		//подготавливаем данные к записи, очистив их от лишних тегов и пробелов
		$post = array_map(function($v){return Validate::cleanStr($v);}, $post);
		//объявляем массив данных для записи в конфигурационный файл
		$dataRecord = [];
		//проверяем была ли нажата кнопка по умолчанию, если да то формируем массив значений по умолчанию, если нет то формируем массив переданных данных
		if (isset($default)) {
			require_once 'config/ConfigDefault.php';
			$arrConfigDef = ConfigChange::getConfig('ConfigDefault');
		}
		foreach ($post as $k=>$v) {
			$k = strtoupper($k);
			$value = isset($default) ? $arrConfigDef[$k] : $v;
			if (!empty($value)) {
				$dataRecord[$k]=$value;
			}
		}
		if (!empty($dataRecord)) return ConfigChange::setConfig($dataRecord);
		else return false;
	}




}
