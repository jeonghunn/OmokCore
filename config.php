<?php if(!defined("642979")) exit();

ini_set('memory_limit', '1024M');

$HELLO_CORE_VERSION = "1.0";
$CORE_VERSION = "1.0.606";
$DEVELOPMENT_SERVER_URL = "unopenedbox.com/develop/omok/";
$SERVER_URL = "unopenedbox.com/develop/omok/";
$MAIN_URL = "http://unopenedbox.com/develop/omok/";
$MAIN_API_URL = "http://unopenedbox.com/develop/omok/api.php";
$CLIENT_SERVER_IP_ADDRESS = "52.78.110.116";
$DEVELOPMENT_MODE = false;

//Database
require_once 'db_config.php';

//Import Modules
$IMPORT_MODULE = array('settings', 'main', 'account', 'board', 'page', 'notification', 'attach', 'omok');


?>