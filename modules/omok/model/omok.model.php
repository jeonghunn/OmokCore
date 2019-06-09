<?php


function Model_Omok_Insert($OMOK_MODEL)
{
    return DBQuery(getSqlInsertQuery('omok', $OMOK_MODEL->get()));
}


function Model_Omok_getLastOne()
{
    return DBQuery('SELECT * FROM  `omok` WHERE  `status` NOT LIKE "deleted" AND `status` NOT LIKE "end" ORDER BY `omok`.`srl` DESC LIMIT 1');
}


function Model_Omok_UpdateData($srl, $data, $tick, $result)
{
    return DBQuery("UPDATE `omok` SET `data` = '$data' ,   `tick` = '$tick',   `result` = '$result' WHERE `srl` = '$srl' AND `status` NOT LIKE 'deleted' AND `status` NOT LIKE 'end'");
}

function Model_Omok_UpdateStatus($srl, $status)
{
    return DBQuery("UPDATE `omok` SET `status` = '$status'   WHERE `srl` = '$srl' AND `status` NOT LIKE 'deleted' AND `status` NOT LIKE 'end'");
}

function Model_Omok_UpdateResult($srl, $result)
{
    return DBQuery("UPDATE `omok` SET `result` = '$result'   WHERE `srl` = '$srl' AND `status` NOT LIKE 'deleted' AND `status` NOT LIKE 'end'");
}

?>