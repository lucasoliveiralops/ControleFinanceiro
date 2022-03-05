<?php

namespace App\Routes;
class Route {
	private $routes;
	private $routeController =  "App\\Controller\\";
	private $routeConfig = "App\\Routes\\configRoutes.json";
	private $urlBase;

	public function __construct($urlBase) {
		$this->setUrl($urlBase);
		$this->initRoutes();
		$this->run($this->getUrl());
	}
	public function getRoutes() {
		return $this->routes;
	}
	private function setUrl($urlBase){
		$this->urlBase = $urlBase;
	}

	public function getUrl(){
		return $this->urlBase;
	}

	private function setRoutes(array $routes){
		$this->routes = $routes;
	}

	private function initRoutes(){
		if(file_exists($this->routeConfig)){
			$routes = file_get_contents($this->routeConfig);
			$routes = \App\Lib\Util::jsonDecode($routes);
		}
		$this->setRoutes($routes);
	}


	private function run($url){
		foreach ($this->getRoutes() as $key => $route){
			if($url == 'home'){
				$url = '';
			}
			if($url == $route['route']){
				if($route['loginIsRequired'] == true && 
						!\App\Lib\Session::getInstanse()->isAuthenticatedUser()
				){
					\App\Lib\Redirect::internalRedirect('login');				
				}
				$class = $this->routeController . ucfirst($route['controller']);
				$method = $route['method'];
				$controller = new $class;
				$controller->$method();
				return;
			}
		}
		$this->notFoundRoute();
	}
	
	public function notFoundRoute(){
		\App\Lib\Redirect::internalRedirect('404');
	}
}