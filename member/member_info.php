<?if(!defined("642979")) exit();

//Connect to DB
 	mysql_select_db('favorite',$db_conn);

//Auth code to user_srl
//require '../auth.php';
//$user_srl = AuthCheck($user_srl_auth, false);

function MemberInfoUpdate($user_srl, $lang){
	global $REMOTE_ADDR;
   $add_info_to_system = "UPDATE `user` SET  `lang` = '$lang' ,`ip_addr` = '$REMOTE_ADDR' WHERE `user_srl` = $user_srl";
            $system_result = mysql_query($add_info_to_system);
}

function ExplodeMemberInfoValue($member_info){
	return explode("//",$member_info);
}


function GetMemberInfo($user_srl){


         //Send Imformation
        $sql ="SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

return $row;


}

//IF use this function you must import auth.php and private.php
function ProfileInfo($user_srl_auth, $profile_user_srl, $member_info){

$user_srl = AuthCheck($user_srl_auth, false);
//Get Member Info
$row = GetMemberInfo($profile_user_srl);
// IF not ownself
if($user_srl != $profile_user_srl){
	
if(Guest_access_profile($member_info) == false) {  
   ErrorMessage("permission_error");
} 

}
return $row;
}

//this is for native application
function Print_member_info($row, $member_info){

    for ($i=0 ; $i < count($member_info);$i++){
   	if(count($member_info) == $i + 1){
echo $row[$member_info[$i]];
}else{
	echo $row[$member_info[$i]]."/LINE/.";
   }

}
    }
    

   
      
?>