<?php
	
	require './config.php';
	require './functions.php';

	define('SSR', isset($_GET['ssr']));

    $page = new class() {
        public $uriPath;
        public $pageName;
        public $data = [];
        public $dataCommon = [];
        public $html = '';

        public function __construct() {
            $this -> uriPath    = getUriPath();
            $this -> pageName   = getPageName();

            $this -> data = getDataBase($this -> pageName)[0];
            $this -> dataCommon = getDataBase($this -> pageName)['common'];

            if (!SSR) {
                include_once getFilePath('layouts', 'default.php');
            } else {
                include_once getFilePath('layouts', 'ajax.php');
            }
        }
    };
