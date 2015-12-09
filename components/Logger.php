<?php
defined('BIT') or die;

class Logger
{
	/*
	* @var object Статическая переменная для создания объекта относительно шаблона одиночки
	*/
	private static $log = null;
	/**
	 * Закрываем магический методы клонирования, сериализации, ансериализации и конструктор
	 */
	private function __clone(){}
	private function __wakeup(){}
	private function __sleep(){}
	private function __construct(){}

	/**
	 *	Статический метод для создания объекта с помощью шаблона одиночки
	 *  @return object Вернет объект класса Logger
	 */
	public static function getLog()
	{
		if(null === self::$log){
			self::$log = new self();
		}
		return self::$log;
	}

	/**
	 *  Метод для записи логов
	 *  @param object $e Объект класса Exception
	 *  @return bool Вернет истину если файл запишется
	 */
	public function writeLog($e)
	{
		$datetime = date('d/m/y H:i:s');
		$msg = date('d/m/y H:i:s').'||';
		$msg .= 'Код: '.$e->getCode().'||';
		$msg .= 'Сообщение: '.$e->getMessage().'||';
		$msg .= 'Линия: '.$e->getLine().'||';
		$msg .= 'Файл: '.$e->getFile()."\n";
		if(!file_put_contents(Config::LOGS, $msg, FILE_APPEND|LOCK_EX)) return false;
		else return true;
	}

	/**
	 *  Считывает файл логов
	 *  @param string $path Путь до файла логов
	 *  @return array Вернет массив логов
	 */
	public function readLog($path)
	{
		if(!file_exists($path) && empty(file($path))) return false;
		$arrLog = array();
		foreach(file($path) as $k=>$v){
			$arrLog[$k] = explode('||', $v);
		}
		return array_reverse($arrLog);
	}

}