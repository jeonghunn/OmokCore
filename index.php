<?php
define('642979',   TRUE);


//HTTPS
//if (!isset($_SERVER['HTTPS'])) {
//    header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
//}


//LOAD

 require_once 'pages/base.php';
require_once 'pages/lib/lib.loader.php'; //Load library
//Variable
$page_srl = GET('p');
$act_parameter = GET('a');
$loaded = false;

//Session
session_start();
$user_auth = $_SESSION['user_auth'];
//Logout


//echo $user_auth;
//Lang

require_once "pages/lang/".getLang().".php";


$game_info = json_decode(PostAct(getAPIUrl(), array(array('a', 'omok_game_status'), array('apiv', getAPIVersion()))), true);

$game_info = $game_info['srl'];






//Guest, User all can
if (getActParameter() == "") $act_parameter = "home";
LoadPages("home", "index", false);
LoadPages("error", "error", false);
LoadPages("info", "info/view/info", false);


//Check Key string
if ($act_parameter != null && !$loaded) {

    $square_key = $act_parameter;
    $square_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_read'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('square_key', $square_key))), true);
//if null
    if ($square_result['square_key'] != null) {
        require_once 'pages/square/view/square_view.php';

        setLoaded(true);
    }


}



function checkLoaded(){
	global $loaded;
	$error_code = 404;
    if (!$loaded) require 'pages/core/error.php';
}


function LoadPages($ACTION, $page_name, $login_need){
	global $act_parameter, $loaded;
$accept = true;
if($login_need) $accept = CheckLogin();
 if($act_parameter == $ACTION){	
if($accept){
require_once 'pages/'.$page_name.'.php';
setLoaded(true);
}else{
	SettoLogin();
}
}
}

function SettoLogin(){
	echo "<meta http-equiv='refresh' content='0;url=login'>";
	setLoaded(true);
}


function setLoaded($b){
	global $loaded;
	$loaded = $b;
}

//Foot
checkLoaded();
if(REQUEST('footer') != 'false') require_once 'pages/footer.php';

?>
