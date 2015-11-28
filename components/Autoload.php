<?php

defined('BIT') or die;

class Autoload
{
	/**
	 *   Метод для автоматического подключения классов
	 *
	 *  @param string $className Имя класса, который необходимо подключить
	 *  @return void
	 */
	public static function loadClass($className)
	{
		$path = [Config::MODEL, Config::CONTROLLER, Config::COMPONENTS];

		foreach ($path as $k => $v) {
			if(file_exists($v.$className.'.php')) {
				require_once $v.$className.'.php';
			}
		}
	}
}
