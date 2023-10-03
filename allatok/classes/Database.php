<?php

class Database {

    private $db = null;

    public function __construct($host,  $username, $pass,$db) {
        $this->db = new mysqli($host,$username, $pass, $db);
    }

    public function login($name, $pass) {
        if ($result = $this->db->query("SELECT * FROM users")) {
            echo "Returned rows are: " . $result->num_rows;
            // Free result set
            $result->free_result();
        }
    }
}
