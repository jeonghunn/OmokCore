<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$page_srl = mysql_real_escape_string($_POST['fav_user_srl']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$category = mysql_real_escape_string($_POST['category']);
$country_code = mysql_real_escape_string($_POST['country_code']);
$phone_number = mysql_real_escape_string($_POST['phone_number']);
$privacy = mysql_real_escape_string($_POST['privacy']);
$log = "$title$$$permission$$$status$$$privacy";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_info_class.php';
require '../member/push_class.php';
require 'documents_class.php';


//Check Value security
Security_value_check($title);
Security_value_check($content);

//Update
if($kind == 0){

}

//Write
if($kind == 1) {
//	$content = urlencode ( $content );
	//REPLACE FIRST
		// str_replace("<enter>", "<br>", $content); 
		// str_replace("<enter>", "<br>", $content); 
	$document_write = document_write($page_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy);
if($document_write == true){
	echo "document_write_succeed";
	
}else{
echo "document_write_error";
}
}




      
?>