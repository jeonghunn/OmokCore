<?php

class OmokModelClass
{
    public $srl, $status, $data, $result, $last_update;

    function get()
    {
        return array('srl' => $this->srl,
            'status' => $this->status,
            'data' => $this->data,
            'result' => $this->result,
            'last_update' => $this->last_update);
    }
}

?>