<?php if(!defined("642979")) exit();

function document_read($user_srl, $doc_srl){
	global $REMOTE_ADDR;
	//$user_srl = AuthCheck($user_srl, false);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));
	$page_info = GetPageInfo($row[page_srl]);
	//View
mysql_query("UPDATE `documents` SET `views` = $row[views] + 1 WHERE `srl` = '$doc_srl'");
if($REMOTE_ADDR != $row['ip_addr']) updatePopularity($user_srl, $row['page_srl'], 1);
//Status
 $status = getDocStatus($user_srl, $doc_srl);

if($status < $page_info['status']) $row = false;
if($status < $row['status']) $row = false;

return $row;
}

//Find lastest number.
 function DocLastNumber(){
  $table_status = mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
  return $table_status['Auto_increment'];  
 }

 function document_status_update($doc_srl, $user_srl, $status){
	global $date, $REMOTE_ADDR;
	//$user_srl = AuthCheck($user_srl, false);
    $status_relation = getDocStatus($user_srl, $doc_srl);
    if($status_relation == 4){
	 $result = mysql_query("UPDATE `documents` SET `status` = '$status'   WHERE `srl` = '$doc_srl'");
}else{
	$result = false;
}
return $result;
 }


function getDocStatus($user_srl, $doc_srl){
//doc owner
$doc_owner = getDocOwner($doc_srl);
$doc_page_owner = getDocPageOwner($doc_srl);

	//Check Status
	if($user_srl != $doc_owner){
	$status = setRelationStatus($user_srl, $doc_page_owner);
}else{
	$status = 4;
}

return $status;

}

function getDocOwner($doc_srl){
	return getDocInfo($doc_srl, "user_srl");
}

function getDocPageOwner($doc_srl){
	$OwnerInfo = GetPageInfo(getDocInfo($doc_srl, "page_srl"));


	return $OwnerInfo[user_srl];

}

function getDocInfo($doc_srl, $info){
	$result =mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` =$doc_srl"));
return $result[$info];
}


function document_update($doc_srl, $user_srl , $namearray, $valuearray){
	global $date, $REMOTE_ADDR;
	//$user_srl = AuthCheck($user_srl, false);
	$relation_status = setRelationStatus($user_srl, $page_srl);
	$user_info = GetPageInfo($user_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$last_number = DocLastNumber();
$result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`, `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '$date', '$permission', '$status', '$privacy', '$REMOTE_ADDR');");
document_send_push($page_srl, $user_srl, $name, $last_number);
//echo mysql_error();
	
return $result;
}


//require attach_class.php
function document_write($page_srl, $user_srl , $title, $content, $permission, $status, $privacy){
	global $date, $REMOTE_ADDR;
//Check Value security
security_value_check($title);
security_value_check($content);
//Start
//	$user_srl = AuthCheck($user_srl, false);
	$relation_status = setRelationStatus($user_srl, $page_srl);
	$user_info = GetPageInfo($user_srl);
	$page_info = GetPageInfo($page_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$last_number = DocLastNumber();
	if($content != "" && $relation_status != -1 && $relation_status >= $page_info[write_status] && $page_info != null) {
$attach_result = attach_file($page_srl, $last_number, $user_srl, $status);
$result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '$date', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '$REMOTE_ADDR');");

if($REMOTE_ADDR != $page_info[ip_addr]) updatePopularity($user_srl, $page_srl, 1);
//Set last update
mysql_query("UPDATE `pages` SET `last_update` = '$date'   WHERE `user_srl` = '$page_srl'");
//Push
document_send_push($page_srl, $user_srl, $name,  $content, $last_number);
}
//echo mysql_error();
	
return $result;
}

function document_edit($user_srl, $lang){

}

function document_delete($user_srl, $lang){

}


function document_send_push($page_srl, $user_srl, $name, $content, $number){
if ($user_srl != $page_srl) sendPushMessage($page_srl, $user_srl, $name, $content, "new_document", 1, $number);
 //if ($user_srl != $page_srl) exec("php /usr/bin/php /var/www/favorite/member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." > /dev/null &");
 //if ($user_srl != $page_srl) proc_close(proc_open ("../member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." &", array(), $foo));
}
function document_getList($user_srl, $doc_user_srl, $start, $number){
//	$user_srl = AuthCheck($user_srl, false);
	$doc_user_srl_info = GetPageInfo($doc_user_srl);
  $status = setRelationStatus($user_srl, $doc_user_srl);
  $row = mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$doc_user_srl AND  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
  if($doc_user_srl_info['status'] > $status || $doc_user_srl_info == null) $row = false;
 return $row;
}

function document_getAllList($user_srl, $start, $number){
//	$user_srl = AuthCheck($user_srl, false);
  $status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}

function document_getUserUpdateList($user_srl, $user_array){
//	$user_srl = AuthCheck($user_srl, false);
for($i=0 ; $i < count($user_array); $i++){
	$doc_user_info = GetPageInfo($user_array[$i]);
	$status = setRelationStatus($user_srl, $user_array[$i]);
	if($doc_user_info['status'] > $status){
$contents[] = "";

	}else{
	if($doc_user_info['status'] <= $status)
 $row = mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$user_array[$i] AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC");
  mysql_data_seek($row, 0);
    $result=mysql_fetch_array($row); 
 $contents[] = $result['title'] == "null" ? $result['content'] : $result['title'];
}
}

return $contents;
}



function document_printUserUpdateList($array){
	for($i=0 ; $i < count($array); $i++){
		if($i == count($array) -1){
           echo $array[$i];
		}else{
			echo $array[$i]."/LINE/.";
		}

	}
}

function document_PrintList($row, $doc_info){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
         echo print_info($result, $doc_info)."/DOC/.";
}         
}




      
?>