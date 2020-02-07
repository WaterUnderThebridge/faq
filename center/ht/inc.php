<?php
ob_start();
 ob_end_flush();

//ini_set('session.use_trans_sid', '1');
error_reporting(5);
//error_reporting(E_ALL);

date_default_timezone_set('PRC');
define('ROOT_PATH', dirname(__FILE__) . '/');
define('LIB_PATH', ROOT_PATH . 'lib/');


require_once (LIB_PATH . "mysql.class.php");
require_once (LIB_PATH . "fileupload.class.php");
require_once (LIB_PATH . "page.class.php");
require_once (LIB_PATH . "function.php");
