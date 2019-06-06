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
if(isset($_COOKIE['AT'])){
    $_SESSION['user_auth'] = $_COOKIE['AT'];
}
$user_auth = $_SESSION['user_auth'];
if(strpos(REQUEST('keep_signed_in'), 'true') !== false)  setcookie('AT', $user_auth, time()+(60*60*24*100) );

//Logout
if($act_parameter == "logout") {
    session_destroy();
    unset($_COOKIE['AT']);
    setcookie('AT', null, 1);
    setLoaded(true);
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}



//echo $user_auth;
//Lang

require_once "pages/lang/".getLang().".php";


$user_info = json_decode(PostAct(getAPIUrl(),  array(array('a', 'my_page_info'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', $user_auth), array('page_info', 'user_srl//tarks_account//admin//name_1//name_2//gender//birthday//country_code//phone_number//join_day//profile_pic//profile_update//lang//country//like_me//favorite//rel_you_status//rel_me_status'))), true);

$user_srl = $user_info['srl'];
$user_name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);


//Check login
if(!CheckLogin()) {


	//signup
	if($act_parameter == "signupact"){
        $signupresult = PostAct(getAPISUrl(), array(array('a', 'account_sign_up'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('email', POST('email')), array('password', POST('password')),  array('name_2', explode("@", POST('email'))[0])));
       $signupresult_array = json_decode($signupresult , true);
        if (strpos($signupresult, 'error') !== false) {
            alert_dialog(T('sign_up_'.$signupresult_array['message']));
            require_once 'pages/signup.php';
            setLoaded(true);
        }else{
            $act_parameter = "loginact"; //login now

		}
	}


//Check loginact

	if($act_parameter == "loginact"){


session_start();
$user_auth = PostAct(getAPISUrl(), array(array('a', 'account_auth'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('email', POST('email')), array('password', POST('password'))));
        if (strpos($user_auth, 'error') !== false) {
            alert_dialog(T('login_failed_des'));
            require_once 'pages/login.php';
}else{
            $_SESSION['user_auth'] = $user_auth;



            echo "<script>window.location.href='index.php?keep_signed_in=".POST("keep_signed_in")."';</script>";


}
setLoaded(true);
	}
	
	if($act_parameter == "login") {
		require_once 'pages/login.php';
		setLoaded(true);
}


}


//Profile
		if($act_parameter == null && $page_srl != null){
		$page_info = getPageInfo($page_srl);
$page_name = SetUserName($page_info['lang'], $page_info['name_1'], $page_info['name_2']);
require 'pages/profile.php'; 
setLoaded(true);
}

//Guest, User all can
if (getActParameter() == "") $act_parameter = "home";
LoadPages("home", "index", false);
LoadPages("error", "error", false);
LoadPages("info", "info/view/info", false);
LoadPages("license", "info/view/license", false);
LoadPages("infodetail", "infodetail", false);
LoadPages("signup", "signup", false);
LoadPages("new", "square/view/square_collection", false);
LoadPages("write", "square/view/square_write", false);
LoadPages("birthday", "birthday/view/birthday_write", false);
LoadPages("add_creator", "square/view/square_add_creator", false);
LoadPages("add_creator_1", "square/view/square_add_creator_1", false);
LoadPages("add_creator_2", "square/view/square_add_creator_2", false);
LoadPages("add_creator_3", "square/view/square_add_creator_3", false);
//API
	    LoadPages("api_main", "api/api_main", false);
		LoadPages("api_add", "api/api_add", true);


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
	if(!$loaded) require 'pages/error.php'; 
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
