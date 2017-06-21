<?php if(!defined("642979")) exit();

    //ip, url, useragent, date
//$siteaddress = "http://tarks.net/develop/favorite/";
//$REMOTE_ADDR  = $_SERVER["REMOTE_ADDR"];
//$nowurl = $_SERVER["REQUEST_URI"];
//$useragent = $_SERVER['HTTP_USER_AGENT'];
//$date = strtotime(date('Y-m-d H:i:s'));
//$CORE_VERSION = "2.34.5.125";

//Language
//$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//if($language == null) $language = "en";

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

//db.php
//require_once 'core/thread.class.php';
require_once 'core/auth.php';

//get lang

$user_srl = AuthCheck($page_auth, 'user_srl', false);
(int) $user_permission_status = 3; // User Permission Default
if($user_srl == null) $user_srl = 0;

require_once 'core/logger.php';
require_once 'core/security.php';
require_once 'core/permission.php';

//Check IP
PermissionCheckAct($user_srl);
IPManageAct(getIPAddr(), getNowUrl(), getTimeStamp());

//Log Client
ActLogSyncTask($user_srl, getIPAddr(),getTimeStamp(), $log_category, $log);
ClientAgentLogSyncTask($user_srl);

//set user_Srl


?>