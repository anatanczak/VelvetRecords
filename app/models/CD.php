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

    public function removeSingleCD($id){
        $query = "DELETE FROM disc WHERE disc_id = :id";
        $params =[
            'id' => $id
        ];
        return $this->db->deleteFromDatabase($query, $params);
    }

    public function addCDWithoutImage($data){
        $query = "INSERT INTO disc(disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id) VALUES(:title, :year, :label, :genre, :price, :artist)";
        $params = [
            'title' => $data['title'],
            'year'  => $data['year'],
            'label' => $data['label'],
            'genre' => $data['genre'],
            'price' => $data['price'],
            'artist' => $data['artist']
        ];
        return $this->db->insertIntoDatabaseAndGetLastInsertedId($query, $params);
    }

    public function updateImageTitle($id, $picture){
        $query = "UPDATE disc SET disc_picture = :picture  WHERE disc_id = :id";
        $params = [
            'id' => $id,
            'picture' => $picture
        ];

        return $this->db->updateInfo($query, $params);
    }


    public function updateAllFieldsWithoutImage($data){
        $query = "UPDATE disc SET disc_title = :title, disc_year = :year, disc_label = :label, disc_genre = :genre, disc_price = :price, artist_id = :artist WHERE disc_id = :id";
        $params = [
            'id' => $data['id'],
            'title' => $data['title'],
            'year'  => $data['year'],
            'label' => $data['label'],
            'genre' => $data['genre'],
            'price' => $data['price'],
            'artist' => $data['artist']
        ];
    }

}