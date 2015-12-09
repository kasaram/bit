<?php
defined('BIT') or die;

class ConfigChange
{
/**
 *  Статический метод для получения конфигураций в виде массива
 *	@param string $configClass Принимает строку названия класса конфигураций
 *  @return array $arrCount Вернет массив конфигураций
 */
public static function getConfig($configClass = 'Config')
{
	$ref = new ReflectionClass($configClass);
	$arrConst = $ref->getConstants();
	return $arrConst;
}

/**
 *  Статический метод для установки новых конфигураций
 *  @param array $arrConfig Массив параметров конфигураций, которые нужно записать
 *  @param string $configClass Наименование класса конфигураций
 *  @param string $path Путь до файла конфигураций, который нужно переписать
 *  @return bool Вернет булево значение, в зависимости от того будут ли установленны новые конфигурации
 */
public static function setConfig($arrConfig, $configClass = 'Config', $path = 'config/Config.php')
{
	if(is_array($arrConfig)){
		$arrConst = self::getConfig($configClass);
		foreach($arrConfig as $k=>$v){
			$arrConst[$k] = $v;
		}
	}else return false;
	return self::writeConfig($arrConst, $configClass, $path);
}

/**
 *  Статический метод, который записывает новые конфигурации в файле
 *  @param array $arrConst Массив новых значений для конфигурационного файла
 *  @param string $configClass Наименование класса конфигураций
 *  @param string $path Путь до файла конфигураций, который нужно переписать
 *  @return bool Вернет истину если удалось произвести запись в файл конфигураций
 */
private static function writeConfig($arrConst, $configClass, $path)
{
	$config = '<?php
	class '.$configClass.'
	{
		';
	foreach($arrConst as $k=>$v){
		$config .= 'const '.$k.' = "'.$v.'";
		';
	}
	$config .= '
	}';
	try{
		if(!file_put_contents($path, $config)){
			throw new Exception('Возникла ошибка при попытке изменения файла конфигураций', 3);
		} else return true;
	}catch(Exception $e){
		$log = Logger::getLog();
		$log->writeLog($e);
	}
}
}
