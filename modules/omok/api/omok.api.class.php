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

        $result = $OMOK_CLASS->tickGame();

        echo $result['data'];
    }

}



