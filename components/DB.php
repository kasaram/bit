<?php

defined('BIT') or die;

class DB
{
	/*
	*		@var null|object Свойство для создания объекта класса DB
	*/
	private static $db = null;

	/*
	*		@var object Свойство для создания объекта класса PDO
	*/
	private $pdo;

	private function __clone(){}
	private function __wakeup(){}
	private function __sleep(){}

	/**
	 *   Конструктор, в котором подключаемся к БД, а так же ловим исключения и пишем в лог в случае ошибки
	 *
	 *  @return void
	 */
	private function __construct()
	{
		try{
			$this->pdo = new PDO(Config::DB_DSN, Config::DB_USER, Config::DB_PASS);
			$this->pdo->query('SET NAME "utf-8"');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			$log = Logger::getLog();
			$log->writeLog($e);
		}
	}

	/**
	 *   Метод для создания объекта текущего класса DB
	 *
	 *  @return object Возвращает объект текщего класса
	 */
	public static function getDB()
	{
		if(null === self::$db){
			self::$db = new self();
		}
		return self::$db;
	}

	/**
	 *   Метод безопасного запроса к БД с использованием индексированых плейсхолдеров
	 *  (учитываем порядок плейсхолдеров в запросе)
	 *
	 *  @param string $sql SQL - запрос к БД
	 *  @param array|scalar $params Принимает массив или
	 *  скалярное значение параметров для sql-запроса
	 *  @return array|bool Вернет массив если выборка или вернет булево значение
	 *  если вставка, обновление или удаление
	 */
	public function query($sql, $params = null)
	{
		try{
			$stmt = $this->pdo->prepare($sql);
			if(!$stmt) return false;
			if(is_array($params) && strpos($sql, '?')){
				foreach($params as $k=>$v){
					$k += 1;
					$stmt->bindValue($k, $v);
				}
			}
			if(is_scalar($params) && strpos($sql, '?')){
				$stmt->bindValue(1, $params);
			}
			$stmt->execute();
			if(stripos($sql, 'SELECT') < 20 && stripos($sql, 'SELECT') !== false){
				$items = [];
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$items[] = $row;
				}
				return $items;
			}
			return true;
		}catch (PDOException $e){
			Logger::getLog()->writeLog($e);
		}
	}

	/**
 	 *  Метод для получения выборки из БД
 	 *
 	 * @param array|string $column Ппринимает массив или строку наименования столбцов
 	 * @param string $table Принимает строку -  наименование таблицы без префикса
 	 * @param array $where Принимает одномерный или двумерный массив для формирования предиката ([['id'=>'='],['AND', 'OR']])
 	 * @param array|string $order Принимает массив или строку для формирования запроса order
	 * (['DESC','id','title'])
 	 * @param array|string $limit Принимает строку или массив данных для указания лимита ([1,3])
 	 * @param array|scalar $params Принимает массив или скалярное значение параметров для sql-запроса
 	 * @return array Вернет массив данных из выборк
	*/
	public function select($column, $table, $where = null, $order = null, $limit = null, $params=null)
	{
		$column = $this->getColumn($column);
		$table = Config::DB_PREFIX.$table;
		if(isset($where)) {
			$where = $this->getWhere($where);
		}
		if(isset($order)) {
			$order = $this->getOrder($order);
		}
		if(isset($limit)) {
			$limit = $this->getLimit($limit);
		}
		$sql = 'SELECT '.$column.' FROM '.$table.$where.$order.$limit;
		$result = $this->query($sql, $params);
		return $result;
	}

	/**
 	 *  Метод для обновления данных в БД
 	 *
 	 * @param string $table Принимает строку -  наименование таблицы без префикса
 	 * @param string|array $data Принимает строку или массив полей, которые нунжно обновить
 	 * @param array $where Принимает одномерный или двумерный массив для формирования предиката ([['id'=>'='],['AND', 'OR']])
 	 * @param array|scalar $params Принимает массив или скалярное значение параметров для sql-запроса
 	 * @return bool Вернет истину или ложь в зависимости от того, было ли выаолнено обновление в БД
	*/
	public function update($table, $data, $where = null, $params = null)
	{
		$table = Config::DB_PREFIX.$table;
		$data = $this->setData($data);
		if(isset($where)) {
			$where = $this->getWhere($where);
		}
		$sql = 'UPDATE '.$table.' SET '.$data.$where;
		$result = $this->query($sql, $params);
		return $result;
	}

	/**
 	 * @breif Метод для вставки данных в БД
 	 *
 	 * @param string $table Принимает строку -  наименование таблицы без префикса
 	 * @param string|array $data Принимает строку или массив полей, которые нунжно вставить
 	 * @param array|scalar $params Принимает массив или скалярное значение параметров для sql-запроса
 	 * @return bool Вернет истину или ложь в зависимости от того, были выставлены новые значения в БД
	*/
	public function insert($table, $data, $params)
	{
			$table = Config::DB_PREFIX.$table;
			$data = $this->setData($data);
			$sql = 'INSERT INTO '.$table.' SET '.$data;
			$result = $this->query($sql, $params);
			if(!$result) throw new Exception ('Не удалось вставить данные в БД');
			return $result;
	}

	/**
 	 *  Метод для удаления данных из БД
 	 *
 	 * @param string $table Принимает строку -  наименование таблицы без префикса
 	 * @param array $where Принимает одномерный или двумерный массив для формирования предиката ([['id'=>'='],['AND', 'OR']])
 	 * @param array|scalar $params Принимает массив или скалярное значение параметров для sql-запроса
 	 * @return bool Вернет истину или ложь в зависимости от того, были удалены новые значения из БД
	*/
	public function delete($table, $where = null, $params = null)
	{
		$table = Config::DB_PREFIX.$table;
		if(isset($where)) {
			$where = $this->getWhere($where);
		}
		$sql = 'DELETE FROM '.$table.$where;
		$result = $this->query($sql, $params);
		return $result;
	}

	/**
 	 *  Закрытый метод добавляет апострофы к именам столбцов и переводит в строку
 	 *
 	 * @param array|string $column Ппринимает массив или строку наименования столбцов
 	 * @return string Вернет отформатированную строку
	*/
	private function getColumn($column)
	{
		if(is_array($column)) {
			$column = array_map(function($v){return '`'.$v.'`';}, $column);
			$strColumn = implode(',', $column);
		} else {
			$strColumn = '`'.$column.'`';
		}
		return $strColumn;
	}

	/**
 	 *  Закртытый метод для получения отформатированного предиката where
 	 *
 	 * @param array $where Принимает одномерный или двумерный массив для формирования предиката ([['id'=>'=','title'=>'='],['AND', 'OR']])
 	 * @return string Вернет отформатированную строку предиката
	*/
	private function getWhere($where)
	{
		$strWhere = ' WHERE ';
		//если не двумерный массив, то возвращаем его в том виде, в котором пришел
		$param = (count($where) > 1 && (count($where[0]) > count($where[1]))) ? $where[0] : $where;
		$i = 0;
		if(is_array($param)) {
			foreach($param as $k=>$v) {
				$condition = isset($where[1][$i]) ? $where[1][$i] : ' ';
				$strWhere .= '`'.$k.'`'.' '.$v.' ? '.$condition;
				$i++;
			}
		}
		return $strWhere;
	}

	/**
 	 *  Закрытый метод для получения отформатированной строки order
 	 *
 	 * @param array|string $order Принимает массив или строку для формирования запроса order, если передаем массив, то первым элементом указываем тип сортировки, а вторым по каким полям сортировать
 	 * @return string Вернет сформированную строку для order
	*/
	private function getOrder($order)
	{
		$strOrder = ' ORDER BY ';
		$sort = '';
		if(is_string($order) && strtoupper($order) == 'RAND') {
			$strOrder .= ' RAND() ';
			return $strOrder;
		}
		if(is_array($order) && strtoupper($order[0]) == 'DESC') {
			$order = array_slice($order, 1);
			$sort = ' DESC ';
		}
		$strOrder .= $this->getColumn($order).$sort;
		return $strOrder;
	}

	/**
 	 *  Закрытый метод для получения отформатированной строки limit
 	 *
 	 * @param array|string $limit Принимает строку или массив данных для указания лимита
 	 * @return string Вернет отформатированую строку лимит
 	*/
	private function getLimit($limit)
	{
		$strLimit = ' LIMIT ';
		if(is_array($limit)) {
			$strLimit .= implode(',', $limit);
			$strLimit = substr($strLimit, 0, -1);
		} else {
			$strLimit .= $limit;
		}
		return $strLimit;
	}

	/**
 	 *  Закрытый метод, который формирует строку обновляемых данных
 	 *
 	 * @param string|array $data Принимает строку или массив полей, которые нунжно обновить
 	 * @return string Вернет строку обновляемых данных для запроса
	*/
	private function setData($data)
	{
		$strData = $this->getColumn($data);
		$arrData = explode(',', $strData);
		$data = array_map(function($v){return $v.' = ?';}, $arrData);
		$strData = implode(',', $data);
		return $strData;
	}

	/**
	 *   Деструктор, в котором производим отключение от БД
	 *
	 *  @return void
	 */
	public function __destruct()
	{
		if(($this->pdo) && (!$this->pdo->errorCode())) $this->pdo = null;
	}
}
