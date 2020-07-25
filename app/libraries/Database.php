<?php
/*
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_Name;

    private $dbHandler;
    private $error;

    public function __construct() {
        //set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Create PDO instance
        try{
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass,
                $options);
        } catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //get all objects from db using a specific query
    public function getResultSetWithQuery($sql){
        $preparedStatement = $this->dbHandler->prepare($sql);
        $preparedStatement->execute();
        return $preparedStatement->fetchALL(PDO::FETCH_OBJ);
    }


    public function getSingleResultWithQuery($sql, $params){
        $preparedStatement = $this->dbHandler->prepare($sql);
        $preparedStatement->execute($params);
        return $preparedStatement->fetchObject();
    }

    public function insertIntoDatabase($sql, $params) {
        $preparedStatement = $this->dbHandler->prepare($sql);
        return $preparedStatement->execute($params);
    }

}