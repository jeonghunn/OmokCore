<?php
define('642979', TRUE);

require_once 'config.php';
require_once 'core/base.php';
require_once 'core/db.php';


//debugMode();

$API_VERSION = (int)REQUEST('apiv');
$ACTION = REQUEST('a');
$page_auth = POST('auth');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;

require_once 'core/auth.php';

$user_srl = AuthCheck($page_auth, 'user_srl', false);
(int)$user_permission_status = 3; // User Permission Default
if ($user_srl == null) $user_srl = 0;

require_once 'core/logger.php';
require_once 'core/security.php';
require_once 'core/permission.php';

// Client log

//Check IP
PermissionCheckAct($user_srl);
$ipmanage = IPManageAct(getIPAddr(), getNowUrl(), getTimeStamp());


//Log Client
if ($ipmanage) {
    ActLog($user_srl, getIPAddr(), getTimeStamp(), $log_category, $log);
    ClientAgentLog($user_srl, getIPAddr(), getUserAgent(), getTimeStamp());
}


//Load Core Library
require_once 'core/lib/Thumbnail.class.php';


//Import Modules
foreach ($IMPORT_MODULE as $a) {
    require_once 'modules/' . $a . '/' . $a . '.loader.php'; // loader
}
foreach ($IMPORT_MODULE as $a) {
    require_once 'modules/' . $a . '/' . $a . '.api.php'; // api
}


?>