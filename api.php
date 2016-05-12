<?php
define('642979',   TRUE);
 require_once 'core/base.php';
 require_once 'core/db.php';

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$page_auth =POST('auth');
//$api_key =REQUEST('api_key');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;


//configure, Load Core System
require_once 'config.php';
//Load Core Library
require_once 'core/lib/Thumbnail.class.php';

//Load Modules.
require_once 'modules/page/page.class.php';
require_once 'modules/member/account.class.php';
require_once 'modules/member/member.class.php';
require_once 'modules/member/tarks_account.class.php';
require_once 'modules/board/documents.class.php';
require_once 'modules/board/comment.class.php';
require_once 'modules/board/attach.class.php';


//Load APIs.
require_once 'api/main.api.class.php';
require_once 'api/page.api.class.php';
require_once 'api/board.api.class.php';
require_once 'api/account.api.class.php';
//require_once 'api/tarks_account.api.class.php';



//$user_srl = AuthCheck($page_auth, false);

//Excute Apis
$API = new APIClass();
$PageAPI = new PageAPIClass();

$AccountAPI = new AccoutApiClass();
//$TarksAccountAPI = new TarksAccountAPIClass();



if($ACTION == "hello_world") $API -> hello_world();
if($ACTION == "CoreVersion") $API -> API_getCoreVersion();


//Page
if($ACTION == "page_info") $PageAPI -> API_getPageInfo($user_srl);
if($ACTION == "my_page_info") $PageAPI -> API_getMyPageInfo($user_srl);
if($ACTION == "page_info_update") $PageAPI -> API_PageInfoUpdate($user_srl);
//Page - ADD
if($ACTION == "page_join") $PageAPI -> API_PageJoin();

//Member
//ㄴTarks
//if($ACTION == "tarks_auth") $TarksAccountAPI -> API_AuthTarksAccount();
//if($ACTION == "make_tarks_authcode") $TarksAccountAPI -> API_MakeTarksAccountAuth();
//if($ACTION == "tarks_sign_up") $TarksAccountAPI -> API_SignUpTarksAccount();
//ㄴfacebook
//if($ACTION == "account_sign_up_with_facebook") $API -> API_MemberSignupWithFacebook();
//if($ACTION == "member_auth_facebook") $API -> API_MemberAuthByFacebook();
//ㄴAccount
if($ACTION == "account_auth") $AccountAPI -> API_AuthAccount();
if($ACTION == "account_sign_up") $AccountAPI -> API_SignUpAccount();





?>