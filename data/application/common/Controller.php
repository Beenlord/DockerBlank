<?php
	
	namespace application\common;
	
	class Controller {
		
		public function index(string $page = "home") {
			var_dump($page);
		}
	}