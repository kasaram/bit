<?php

defined('BIT') or die;

class Message
{
	/**
	 * Статический метод позволяющий получить настройки ini-файла
	 * @param string $path Принимает строку пути до файла ini
	 * @return array Вернет массив настроек файла ini
	 */
	private static function get($path = Config::TEXT)
	{
		return parse_ini_file($path, true);
	}

	/**
	 * Статический метод для получения сообщения об ошибке или успехе проведения операции
	 * @param string $getParam Принимает строку в виде наименования настройки ini файла 
	 * @return bool|string Вернет false, если переданной настройки нет в ini файле или вернет строку
	 *  содержащию сообщение
	 */
	public static function getMsg($getParam)
	{
    	$msg = self::get();
    	$getParam = strtoupper($getParam);

      if (key_exists($getParam, $msg['SUCCESS'])) {
        //$style = 'color:#5cd212;';
        $class = 'msgSuc';
        $text = $msg['SUCCESS'][$getParam];
      } else if (key_exists($getParam, $msg['FAIL'])) { 
        //$style = 'color:#d21212;';
        $class = 'msgFail';
        $text = $msg['FAIL'][$getParam];
      } else return false;
			return '<p class="'.$class.'">'.$text.'</p>';
	}

}
