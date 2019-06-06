<?php


function Model_Omok_Insert($OMOK_MODEL)
{
    return DBQuery(getSqlInsertQuery('omok', $OMOK_MODEL->get()));
}


function Model_Omok_getLastOne()
{
    return DBQuery('SELECT * FROM  `omok` WHER  `status` NOT LIKE "deleted" ORDER BY `omok`.`srl` DESC LIMIT 1');
}


?>