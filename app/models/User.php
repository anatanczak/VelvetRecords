<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    //find a user by email
    public function verifyEmail($email) {
        $query = "SELECT email
                    FROM users
                    WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $email = $this->db->getSingleResultWithQuery($query, $params);

        return $email ? true : false;
    }

    public function register($data){
        $query = "INSERT INTO users(first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)";
        $params = [
            'last_name' => $data['lastName'],
            'first_name' => $data['firstName'],
            'email' => $data['email'],
            'password' => $data['password']
        ];
        return $this->db->insertIntoDatabase($query, $params);
    }

    public function login($email, $password){
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [
            'email' => $email
        ];
        $hashedPassword = null;
        $row = $this->db->getSingleResultWithQuery($query, $params);

        if($row){
            $hashedPassword = $row->password;

        }

        if(password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}