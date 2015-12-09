<?php
defined('BIT') or die;

class Games
{
	/**
	 * Статический метод, который задает параметры игры
	 * @return array Вернет массив содержащий данные игры
	 */
	public static function loadGame()
	{
		//обнуляем клики для формирования правильного dataBox
		$_SESSION['clicksBox'] = [];
		$claimAmountBefore = !empty($_SESSION['claimAmount']) ? $_SESSION['claimAmount'] : 0;
		$bonusMinutesBefore = !empty($_SESSION['bonusMinutes']) ? $_SESSION['bonusMinutes'] : 0;
		$boxes = Games::getBox();
		$dataBox = Games::getDataBox('bag-opened', 'bag');
		$dataGame = [
			'boxes'=>$boxes, 
			'dataBox'=>$dataBox, 
			'clicksBox'=>[], 
			'claimAmountBefore'=>$claimAmountBefore, 
			'bonusMinutesBefore'=>$bonusMinutesBefore, 
			'claimAmount'=>$claimAmountBefore, 
			'bonusMinutes'=>$bonusMinutesBefore, 
			'numChance'=>Config::NUM_CHANCE
		];
		return $dataGame;
	}

	/**
	 * Статический метод для установки времени до следующей игры
	 * @param int $minutes Принимает число секунд до следующей игры
	 * @return bool Вернет булево значение в зависимости от того установилось время или нет
	 */
	public static function setPauseGame($time)
	{
		$userId = $_SESSION['id'];
		return User::changeUser(['pauseGame'=>$time], $userId);
	}

	/**
	 * Статический метод для показа всех данных боксов
	 * @param string $classOpen Класс-css для открытых боксов
	 * @return array Вернет многомерный массив
	 */
	public static function showDataBox($classOpen = null)
	{
		$openBox = [];
		if(isset($_SESSION['boxes'])) {
			for ($i=0; $i < Config::NUM_BOXES; $i++) {
				$val = $_SESSION['boxes'][$i];
				$openBox[$i] = ['class'=>$classOpen, 'val'=>$val]; 
			}
		}
		return $openBox;
	}

	/**
	 * Статический метод для формирования и получения данных бля боксов
	 * @param string $classOpen Класс-css для открытых боксов
	 * @param string $classClose Класс-css для закрытых боксов
	 * @return array Вернет многомерный массив
	 */
	public static function getDataBox($classOpen = null, $classClose = null)
	{
		$databox = [];
		//обнуляем или задаем значения прошлой игры, если пользователь залогинился
		if(isset($_SESSION['bitcoin'])) {
			$_SESSION['claimAmount'] = !empty($_SESSION['claimAmountBefore']) ? $_SESSION['claimAmountBefore'] : 0;
			$_SESSION['bonusMinutes'] = !empty($_SESSION['bonusMinutesBefore']) ? $_SESSION['bonusMinutesBefore'] : 0;
		}
		for ($i=0; $i < Config::NUM_BOXES; $i++) { 
			//проверяем клики 
			if (isset($_SESSION['clicksBox']) && in_array($i, $_SESSION['clicksBox'])) {
				$val = $_SESSION['boxes'][$i];
        $class = $classOpen;
        //если выбраны сатоши то пишем в сессию
        if (strpos($val, strtolower(Config::COIN)) !== false) {
          sscanf($val, '%d %s', $numCA, $str);
          $_SESSION['claimAmount'] += $numCA;
        }
        //если выбраны бонусы пишем в сессию
        if (strpos($val, 'bonus') !== false) {
          sscanf($val, '%d %s', $numBM, $str);
          $_SESSION['bonusMinutes'] += $numBM;
        }
			} else {
				$class = $classClose;
      	$val = '';
    	}
			$databox[$i] = ['class'=>$class, 'val'=>$val];
		}
		return $databox;
	}
	
	/**
	 * Статический метод, который возвращает перемешанный массив победных, бонусных и пустых значений 
	 * @return string Вернет строку содержащую массив
	 */
	public static function getBox() 
	{
		//подготавливаем массив выйгрышных значений
		$wins = self::getArr(Config::NUM_WINS, Config::MIN_AMOUNT, Config::MAX_AMOUNT, Config::COIN);
		//подготавливаем массив бонусных значений 
		$bonus = self::getArr(Config::NUM_BONUSES, Config::MIN_BONUS, Config::MAX_BONUS, 'bonus');
		//складываем два массива
		$winBon = array_merge($wins, $bonus);
		//увеличиваем размер массива до определенного значения
		$boxes = array_pad($winBon, Config::NUM_BOXES, 0);
		shuffle($boxes);
		return $boxes;
	} 


	/**
	 * Закрытый статический метод для получения массива случайных чисел
	 * @param int|string $num Принимает занчение количества итераций 
	 * @param int|string $min Принимает минимальное значение
	 * @param int|string $max Принимает максимальное значение
	 * @param string|null $key Принимает строковое значение наименования валюты или бонуса
	 * @return array Вернет массив сгенерированных случайных чисел
	 */
	private static function getArr($num, $min, $max, $val)
	{
		for($i=0; $i < $num; $i++) {
			$arr[$i] = mt_rand($min, $max).' '.strtolower($val);
		}
		return $arr;
	}


}
