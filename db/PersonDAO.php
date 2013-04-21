<?php

class PersonDAO extends GenericDAO
{
    function findByGroupId($group_id) {
        $result = array();
        
        $query = "SELECT * FROM offthegrid.".$this->tableName." WHERE group_id = ".$group_id;
        
        try {
            foreach ($this->db->query($query) as $row) {
                $obj = new $this->tableName;
                foreach ($obj as $key => $value) {
                    $obj->$key = $row[$key];
                }
                $result[] = $obj;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
        return $result;
    }
}

?>
