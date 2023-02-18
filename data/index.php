<?php
	
	require './config.php';
	require './functions.php';
	
	define('URI', explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0]);
	define('SSR', isset($_GET['SSR']));
	
	
	