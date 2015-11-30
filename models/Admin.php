<?php
defined('BIT') or die;

class Admin
{

	/**
 	 *  Статический метод, который сохраняет новые конфигурации в файл
 	 *
 	 * @param array $post Принимает массив данных новых конфигураций
 	 * @param bool|null $default Принимает булево значение, если истина то установит значения 
 	 * по умолчанию
 	 * @param string $configClass Наименование класса конфигураций
	 * @param string $path Путь до файла конфигураций, который нужно переписать
 	 * @return bool Вернет булево значени в зависимости от того удалось ли переписать конфигурационный файл
	*/
	public static function saveConfig($post, $default=null, $configClass = 'Config', $path = 'config/config.php')
	{
		//удаляем последний элемент массива - ключ и значение кнопки отправки
		array_pop($post);
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
		if (!empty($dataRecord)) return ConfigChange::setConfig($dataRecord, $configClass, $path);
		else return false;
	}

	/**
	 * Статический метод для проверки и авторизации администратора
	 * @param string $log Принимает строку содержащию логин администратора
	 * @param string $pass Принимает строку содержащию пароль администратора
	 * @return bool Вернет булево значение в зависимтости от того прошли верификацию отправленны 
	 * данные или нет
	 */
	public static function loginAdmin($log, $pass)
	{
		if ((strtoupper($log) == strtoupper(AdminConfig::ADM_LOG)) && $pass == AdminConfig::ADM_PASS) {
			if(session_status() !== PHP_SESSION_ACTIVE) session_start();
			$_SESSION['adm_log'] = $log;
			$_SESSION['adm_pass'] = $pass;
			return true;
		} else return false;
	}


}
