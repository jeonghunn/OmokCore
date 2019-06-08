<?php

class OmokClass
{

    function tickGame($team, $x, $y, $tick)
    {
        $last = mysqli_fetch_array($this->getLastOne());

//Check game available.
        if ($last['srl'] == null) return false;
//Check this turn is correct
        if ($last['tick'] != $tick) return false;

        $map = json_decode($last['data']);

        $map[$y][$x] = $team;

        $tick = $tick + 1;


        return false;
    }

    function getLastOne()
    {
        return Model_Omok_getLastOne();
    }


    function updateGame($srl, $x, $y)
    {
        if ($x == null || $y == null) return false;


    }


}

?>