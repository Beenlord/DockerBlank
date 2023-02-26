<?php
	
	namespace core;
	
	class Application {
		private $action = "page";
		private $method = "index";
		private $params = [];
		
		public function __construct() {
			
			
			
			//			$uri = self::parseUri();
			//
			//			if (isset($uri[0]) && file_exists(F_CONTROLLS . DS . $uri[0] . PHP)) {
			//				$this->action = $uri[0];
			//				unset($uri[0]);
			//			}
			//
			//			require_once F_CONTROLLS . DS . $this->action . PHP;
			//
			//			$this->action = new $this->action();
			//
			//			if (isset($uri[1]) && method_exists($this->action, $uri[1])) {
			//				$this->method = $uri[1];
			//				unset($uri[1]);
			//			}
			//
			//			if (count($uri)) {
			//				$this->params = $uri;
			//			}
			//
			//			call_user_func_array([$this->action, $this->method], $this->params);
		}
		
		static function getUri() {
			$uri = explode("?", $_SERVER["REQUEST_URI"])[0];
			$parts = explode(DS, trim($uri, DS));
			return $parts && $parts[0] ? $parts : [];
		}
	}