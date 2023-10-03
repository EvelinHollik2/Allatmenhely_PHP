<?php

class Database {

    private $db = null;

    public function __construct($host, $username, $pass, $db) {
        $this->db = new mysqli($host, $username, $pass, $db);
    }

    public function login($name, $pass) {
        //-- jelezzük a végrehajtandó SQL parancsot
        $stmt = $this->db->prepare('SELECT * FROM users WHERE name LIKE ?;');
        //-- elküldjük a végrehajtáshoz szükséges adatokat
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            //-- Sikeres végrehajtás után lekérjül az adatokat
            $result = $stmt->get_result();
            echo '<pre>';
            var_dump($result);
            echo '<pre>';
            echo "Returned rows are: " . $result->num_rows;
            // Free result set
            $result->free_result();
        }
        return false;
    }
}
