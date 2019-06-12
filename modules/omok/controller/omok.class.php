<?php

class OmokClass
{

    function tickGame($team, $x, $y, $tick)
    {
        $last = mysqli_fetch_array($this->getLastOne());
        $result = $last['result'];
//Check game available.
        if ($last['srl'] == null) return false;
//Check this turn is correct
        if ($last['tick'] != $tick) return array('tick' => $last['tick'], 'data' => $last['data'], 'result' => $result);
        if ($team == 1 && $tick % 2 != 0) return false;
        if ($team == 2 && $tick % 2 == 0) return false;

        $map = json_decode($last['data']);


        if ($map[$y][$x] != 0) return false;
        $map[$y][$x] = $team;

        $tick = $tick + 1;

        $color = 0;
        //Winner?
        for ($x = 0; $x < 15; $x++)
            for ($y = 0; $y < 15; $y++)
                if ($map[$x][$y] != 0)
                    for ($h = 0; $h < 2; $h++)
                        for ($l = -1; $l < 2; $l++) {
                            $color = $map[$x][$y];
                            for ($k = 0; $k < 5; $k++) {
                                $PX = $x + $k * $h;
                                $PY = $y + $k * ($l ** $h);
                                if (!$map[$PX] || $color !== $map[$PX][$PY]) {
                                    $color = 0;
                                    break;
                                }
                            }
                            if ($color != 0) {
                                $result = $color;
                                break;
                            }

                        }

        if ($x == null || $y == null) return array('tick' => $tick, 'data' => $last['data'], 'result' => $result);
        $this->updateGame($last['srl'], $map, $tick, $result);


        return array('tick' => $tick, 'data' => EncodeJson($map), 'result' => $result);
    }


    function getLastOne()
    {
        return Model_Omok_getLastOne();
    }


    function updateGame($srl, $data, $tick)
    {


        return Model_Omok_UpdateData($srl, EncodeJson($data), $tick);

    }

    function startGame()
    {
        $newGame = new OmokModelClass();
        $newGame->data = EncodeJson(array(array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0), array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)));
        return Model_Omok_Insert($newGame);
    }


}

?>