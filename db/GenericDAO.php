<?php

class GenericDAO
{
    private $db;
    private $tableName;
    
    function __construct($tableName) {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=offthegrid', "root", "");
            //$this->dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $this->tableName = $tableName;
    }

    function create($obj) {
        $query = "INSERT INTO offthegrid.".$this->tableName."(";

        foreach ($obj as $key => $value) {
            if ($key != "id")
                $query .= $key.", ";
        }

        $query = substr($query, 0, -2); // Remove last blank+comma
        $query .= ") VALUES(";

        foreach ($obj as $key => $value) {
            if ($key != "id") {
                if (!is_string($value))
                    $query .= $value.", ";
                else
                    $query .= "'".$value."', ";
            }
        }
        $query = substr($query, 0, -2); // Remove last blank+comma
        $query .= ")";
                
        if ($this->db->exec($query) != 1)
            throw new Exception ("More or less than 1 row have been inserted! Query: ".$query);
        
        $obj->id = $this->db->lastInsertId();
    }

    function retrieve($id) {
        $query = "SELECT * FROM offthegrid.".$this->tableName." WHERE id=".$id;
        
        try {
            foreach ($this->db->query($query) as $row) {
                $obj = new $this->tableName;
                foreach ($obj as $key => $value) {
                    $obj->$key = $row[$key];
                }
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
        return $obj;
    }

    function update($id, $obj) {
        $query = "UPDATE offthegrid.".$this->tableName." SET ";

        foreach ($obj as $key => $value) {
            if ($key != "id") {
                if (!is_string($value))
                    $query .= $key." = ".$value.", ";
                else
                    $query .= $key." = '".$value."', ";
            }
        }
        $query = substr($query, 0, -2); // Remove last blank+comma
        $query .= " WHERE id = ".$id;
                
        if ($this->db->exec($query) > 1)
            throw new Exception ("More than 1 row have been updated! Query: ".$query);
    }

    function delete($id) {
        $query = "DELETE FROM offthegrid.".$this->tableName." WHERE id = ".$id;
                
        if ($this->db->exec($query) != 1)
            throw new Exception ("More or less than 1 row have been inserted! Query: ".$query);
    }

    function findAll() {
        $result = array();
        
        $query = "SELECT * FROM offthegrid.".$this->tableName;
        
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
