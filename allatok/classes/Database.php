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
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                //-- felhasználónév és jelszó helyes
                $_SESSION['username'] = $row['name'];
                $_SESSION['login'] = true;
            } else {
                $_SESSION['username'] = '';
                $_SESSION['login'] = false;
            }

            // Free result set
            $result->free_result();
        }
        return false;
    }

    public function register($name, $pass) {
        $stmt = $this->db->prepare("INSERT INTO `users` (`name`, `password`) VALUES (?, ?);");
        $stmt->bind_param("sb", $name, password_hash($pass, PASSWORD_BCRYPT));
        if ($stmt->execute()) {
            $_SESSION['login'] = true;
            header("Location: index.php");
        }
    }
}
