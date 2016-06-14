<?php


class CommentClass
{

    function comment_read($user_srl, $doc_srl)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $row = mysqli_fetch_array(DBQuery("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));

        $status = setRelationStatus($user_srl, $row['page_srl']);

        if ($status < $row['status']) return false;

        return $row;
    }

//Find lastest number.
    function CommentLastNumber()
    {
        $table_status = mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'comments'"));
        return $table_status['Auto_increment'];
    }


//Require documents_class.php
    function comment_status_update($PAGE_CLASS, $DOCUMENT_CLASS, $comment_srl, $user_srl, $status)
    {
        $cmt_info = $this->getComment($comment_srl);
        //$user_srl = AuthCheck($user_srl, false);
        $status_relation = $this->getCommentStatus($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $comment_srl);
        if ($status_relation == 4) {
            $result = DBQuery("UPDATE `comments` SET `status` = '$status'  WHERE `srl` = '$comment_srl'");
            $this->setDocCommentCount($cmt_info['doc_srl']);
        }
        return $result;
    }


//Require documents_class.php
    function getCommentStatus($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $comment_srl)
    {

        $cmt_info = $this->getComment($comment_srl);
//doc owner
        $doc_owner = $DOCUMENT_CLASS->getDocOwner($cmt_info['doc_srl']);
        $doc_page_owner = $DOCUMENT_CLASS->getDocPageOwner($PAGE_CLASS, $cmt_info['doc_srl']);
        $doc_page_owner_info = $PAGE_CLASS->GetPageInfo($doc_page_owner);
        $doc_page_owner_admin = $doc_page_owner_info['admin'];

        //Check Status
        if ($user_srl != $cmt_info['user_srl'] && $user_srl != $doc_owner && $user_srl != $doc_page_owner && $user_srl != $doc_page_owner_admin) {
            $status = setRelationStatus($user_srl, $comment_owner);
        } else {
            $status = 4;
        }

        return $status;

    }


    function getCommentInfo($srl, $info)
    {
        $result = $this->getComment($srl);
        return $result[$info];
    }

    function getComment($srl)
    {
        $result = mysqli_fetch_array(DBQuery("SELECT * FROM  `comments` WHERE  `srl` =$srl"));
        return $result;
    }


    function comment_write($PAGE_CLASS, $DOCUMENT_CLASS, $PUSH_CLASS, $doc_srl, $user_srl, $content, $permission, $privacy)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $user_info = $PAGE_CLASS->GetPageInfo($user_srl);
        $name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);
        $document = $DOCUMENT_CLASS->document_read($PAGE_CLASS, $user_srl, $doc_srl ,null);
        $last_number = $this->CommentLastNumber();
        if ($content != "" && $document != null) {
            $result = DBQuery("INSERT INTO `comments` (`doc_srl`, `user_srl`, `name`, `content`, `date`, `status`, `privacy`, `ip_addr`) VALUES ('$doc_srl', '$user_srl', '$name', '$content', '" . getTimeStamp() . "', '$document[status]', '$privacy', '" . getIPAddr() . "');");
            //SetCount
            $this->setDocCommentCount($doc_srl);
            if (getIPAddr() != $document['ip_addr']) $PAGE_CLASS->updatePopularity($user_srl, $document['page_srl'], 1);
            //Send Alert
            $this->comment_send_push($PUSH_CLASS, $document['user_srl'], $doc_srl, $user_srl, $name, $content, $doc_srl);
        }
//echo mysqli_error();

        return $result;
    }

    function comment_edit($user_srl, $lang)
    {

    }

    function comment_delete($user_srl, $lang)
    {

    }

    function setDocCommentCount($doc_srl)
    {
        $count = $this->getCommentCount($doc_srl);
        $comment_count = DBQuery("UPDATE `documents` SET `comments` = '$count' WHERE `srl` = '$doc_srl'");
    }

    function getCommentCount($doc_srl)
    {
        $comment_count = DBQuery("SELECT * FROM  `comments` WHERE  `doc_srl` = '$doc_srl' AND `status` != '5'");
        $total = mysqli_num_rows($comment_count);

        return $total;
    }


    function comment_send_push($PUSH_CLASS, $doc_user_srl, $doc_srl, $user_srl, $name, $content, $number)
    {
        $row = DBQuery("SELECT user_srl FROM  `comments` WHERE  `doc_srl` =$doc_srl AND `status` < 5  ORDER BY  `comments`.`srl`");
        $total = mysqli_num_rows($row);
        if ($total < 150) {
//Delete same id
            $sent = array();
            for ($i = 0; $i < $total; $i++) {
                mysqli_data_seek($row, $i);           //포인터 이동
                $result = mysqli_fetch_array($row);        //레코드를 배열로 저장
                $sent[] = $result['user_srl'];
            }
            $sent[] = $doc_user_srl;
            $sent = array_unique($sent);
            if ($doc_user_srl == $user_srl) $sent = arr_del($sent, $doc_user_srl);
            $sent = arr_del($sent, $user_srl);
//re sort
            foreach ($sent as $a => $b) if ($b == '') unset($sent[$a]);
            $sent = array_values($sent);

            for ($i = 0; $i < count($sent); $i++) {


                $PUSH_CLASS ->  sendPushMessage($sent[$i], $user_srl, $name, $content, "new_comment", 2, $number);

            }
        }
    }


    function comment_getList($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $doc_srl, $start, $number)
    {
//	$user_srl = AuthCheck($user_srl, false);
        $status = $DOCUMENT_CLASS -> getDocStatus($PAGE_CLASS, $user_srl, $doc_srl);
        return DBQuery("SELECT * FROM  `comments` WHERE  `doc_srl` =$doc_srl AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `comments`.`srl` ASC LIMIT $start , $number");
    }


    function comment_PrintList($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $row, $comment_info)
    {

        $total = mysqli_num_rows($row);
        for ($i = 0; $i < $total; $i++) {
            mysqli_data_seek($row, $i);           //포인터 이동
            $result = mysqli_fetch_array($row);        //레코드를 배열로 저장
            //  echo print_info($result, $doc_info);
          $result['you_comment_status'] = $this ->  getCommentStatus($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $result['srl']);
            $array[] = array_info_match($result, $comment_info);
        }



        echo json_encode($array);



    }


}
?>