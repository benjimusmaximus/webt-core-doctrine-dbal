<?php

namespace Htlw3r\DoctrineDbal;

class rpsValue
{
    private $value_id;
    private $name;

    /**
     * @param $value_id
     * @param $name
     */
    public function __construct($value_id, $name)
    {
        $this->value_id = $value_id;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValueId()
    {
        return $this->value_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}

