<?php


function Model_Omok_Insert($OMOK_MODEL)
{
    return DBQuery(getSqlInsertQuery('omok', $OMOK_MODEL->get()));
}


function Model_Omok_getLastOne()
{
    return DBQuery('SELECT * FROM  `omok` WHERE  `status` NOT LIKE "deleted" AND  `status` NOT LIKE "end" ORDER BY `omok`.`srl` DESC LIMIT 1');
}


?>