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
                    ON d.artist_id = a.artist_id";
        return $this->db->getResultSetWithQuery($query);
    }


    public function getSingleCD($id){
        $query = "SELECT * 
                    FROM disc d
                    JOIN artist a
                    ON d.artist_id = a.artist_id
                    WHERE d.disc_id = :id";
        $params = [
            'id' => $id
        ];
        return $this->db->getSingleResultWithQuery($query, $params);
    }

}