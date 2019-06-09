<?php if (!defined("642979")) exit();

class OmokAPIClass
{

    function hello_world()
    {
        echo "Hello World!";
    }

    function API_Tick()
    {
        $OMOK_CLASS = new OmokClass();
        $x = REQUEST('x');
        $y = REQUEST('y');
        $team = REQUEST('team');
        $tick = REQUEST('tick');

        $result = $OMOK_CLASS->tickGame($team, $x, $y, $tick);

        echo $result['tick'] . "/" . $result['data'] . "/" . $result['result'];
    }

    function API_Start()
    {
        $OMOK_CLASS = new OmokClass();

        $result = $OMOK_CLASS->startGame();

        echo $result;
    }
}



