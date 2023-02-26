<?php
	
	namespace application;
	
	class Application {
		private $controller = "application\controllers\PageController";
		private $method = "index";
		private $params = [];
		
		public function __construct() {
			
			$uriArray = self::getUri();
			
			if (isset($uriArray[0]) && class_exists("application\controllers\\" . ucfirst($uriArray[0]) . "Controller")) {
				$this->controller = "application\controllers\\" . ucfirst($uriArray[0]) . "Controller";
				unset($uriArray[0]);
			}
			
			$this->controller = new $this->controller();
			
			if (isset($uriArray[1]) && method_exists($this->controller, $uriArray[1])) {
				$this->method = $uriArray[1];
				unset($uriArray[1]);
			}
			
			$this->params = $uriArray;
			
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
		
		private static function getUri() {
			$uri = explode("?", $_SERVER["REQUEST_URI"])[0];
			$parts = explode(DS, trim($uri, DS));
			return $parts && $parts[0] ? $parts : [];
		}
	}