<?php
class Artist {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllArtists() {
        $query = "SELECT * FROM artist";
        return $this->db->getResultSetWithQuery($query);
    }

}