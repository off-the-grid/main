<?php

class Person
{
	public $group_id;
    public $number;
    
    function __construct($group_id, $person_number) {
        $this->group_id = $group_id;
        $this->number = $person_number;
    }
}

?>

