<?php

namespace App\Routes;

class Route
{
	private $routes = array();
	private $routeController =  "App\\Controller\\";
	private $routeConfig = "App\\Routes\\configRoutes.json";
	private $routeConfigAjax = "App\\Routes\\configRoutesAjax.json";
	private $urlBase;

	public function __construct($urlBase)
	{
		$this->setUrl($urlBase);
		$this->initRoutes();
		$this->initRoutesAjax();
		$this->run($this->getUrl());
	}
	public function getRoutes()
	{
		return $this->routes;
	}
	private function setUrl($urlBase)
	{
		$this->urlBase = $urlBase;
	}

	public function getUrl()
	{
		return $this->urlBase;
	}

	private function setRoutes(array $routes)
	{
		$this->routes = array_merge($this->routes, $routes);
	}

	private function initRoutes()
	{
		if (file_exists($this->routeConfig)) {
			$routes = file_get_contents($this->routeConfig);
			$routes = \App\Lib\Json::decode($routes);
		}
		$this->setRoutes($routes);
	}


	private function initRoutesAjax()
	{
		if (file_exists($this->routeConfigAjax)) {
			$routes = file_get_contents($this->routeConfigAjax);
			$routes = \App\Lib\Json::decode($routes);
		}
		$this->setRoutes($routes);
	}


	private function run($url)
	{
		foreach ($this->getRoutes() as $key => $route) {
			if ($url == 'home') {
				$url = '';
			}
			if ($url == $route['route']) {
				if (
					$route['loginIsRequired'] == true &&
					!\App\Lib\Session::getInstanse()->isAuthenticatedUser()
				) {
					\App\Lib\Redirect::internalRedirect('login');
				}
				$class = $this->routeController . ucfirst($route['controller']);
				$method = $route['method'];
				$controller = new $class;
				$controller->$method();
				$content = $controller->getOutput();
				if (isset($route['isRouteAjax']) && !$route['isRouteAjax']) {
					if ($controller->justMiddle == false) {
						$structure = new \App\Controller\Structure();
						$structure->headerPage();
						$content =  $structure->getOutput() . 	$content;
					}
					if ($controller->justMiddle == false) {
						$structure = new \App\Controller\Structure();
						$structure->footerPage();
						$content .=  $structure->getOutput();
					}
				}
				echo $content;
				return;
			}
		}
		$this->notFoundRoute();
	}

	public function notFoundRoute()
	{
		\App\Lib\Redirect::internalRedirect('404');
	}
}
