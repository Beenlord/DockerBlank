<?php
	
	spl_autoload_register('AutoloaderRegister');
	
	function AutoloaderRegister($className) {
		$requirePath = str_replace("\\", "/", $className) . ".php";
		if (file_exists($requirePath)) {
			require $requirePath;
		}
	}
	
	
	