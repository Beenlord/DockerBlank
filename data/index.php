<?php

 define("DS", DIRECTORY_SEPARATOR);
 define("CMS_ROOT", dirname(  __FILE__));

 $fileBinPath = CMS_ROOT . DS . "public/lab.svg";

 echo file_get_contents($fileBinPath);
