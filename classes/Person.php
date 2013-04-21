<?php

class Person
{
	public $id;
    public $number;
    public $score;
    public $group_id;
    
    function __construct($group_id = -1, $person_number = -1) {
        $this->group_id = $group_id;
        $this->number = $person_number;
        $this->score = 100;
    }
}

?>

