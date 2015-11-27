<?php
class Router
{
	/*
	*		@var array Массив, в котором хранятся маршруты
	*/
	private $routes;

	public function __construct()
	{
		$routesPath=ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	/**
	 *  @brief Метод получения строки запроса
	 *
	 *  @return string Возвращает строку запроса
	 */
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	/**
	 *  @brief Метод принимающий управление от фронт контроллера
	 *
	 *  @return void
	 */
	public function run()
	{
		//получение строки запроса
		$uri = $this->getUri();
		$i = 1;
		//проверка наличия данного запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("~$uriPattern~", $uri)) {
				//получаем внутренний путь из внешнего согласно параметру
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				//определение контроллера и экшена обрабатывающего запрос
				$segments = explode('/', $internalRoute);

				$controllerName = ucfirst(array_shift($segments).'Controller');

				$actionName = 'action'.ucfirst(array_shift($segments));

				$parameters = $segments;

				//Создание объекта контроллера и вызов его экшена
				$controllerObject = new $controllerName();
				$result = $controllerObject->$actionName();
				if ($result != null) {
					break;
				}
			} else if(count($this->routes) == $i){
				//если нет совпадений или введен не существующий адрес, то вызовет MainController
				$controllerObject = new SiteController();
				$result = $controllerObject->actionIndex();
			}
			$i++;
		}
	}
}
