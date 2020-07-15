<?php
class CD {
    private $db;

    public function __construct() {
    $this->db = new Database();
    }

    public  function getAllCDs(){
        $query = "SELECT * 
                    FROM disc d
                    JOIN artist a
                    WHERE d.artist_id = a.artist_id";
        return $this->db->getResultSetWithQuery($query);
    }
}