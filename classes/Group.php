<?php

class Group
{
	public $id;
    public $name;
    
    private $persons;
    
    function __construct() {
        $this->persons = array();
    }
    
    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->name;
        }
    }
    
    function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->name = $value;
        }
        return $this;
    }
}

?>

