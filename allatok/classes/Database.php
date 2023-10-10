<?php

class Database {

    private $db = null;

    public function __construct($host, $username, $pass, $db) {
        $this->db = new mysqli($host, $username, $pass, $db);
    }

    public function login($name, $pass) {
        //-- jelezzük a végrehajtandó SQL parancsot 
        $stmt = $this->db->prepare('SELECT * FROM users WHERE users.name LIKE ?;');
        //-- elküdjük a végrehajtáshoz szükséges adatokat
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            //-- sikeres végrehajtás után lekérjük az adatokat
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            //var_dump(password_hash($pass, PASSWORD_ARGON2I));
            var_dump($row['password'],$pass);
            if ($pass == $row['password']) {
                //-- felhasználónáv és jelszó helyes
                $_SESSION['username'] = $row['name'];
                $_SESSION['login'] = true;
            } else {
                $_SESSION['username'] = '';
                $_SESSION['login'] = false;
            }
            // Free result set
            $result->free_result();
            header("Location: index.php");
        }
        return false;
    }

    public function register($emailcim, $igazolvanyszam, $name, $pass) {
        //$password = password_hash($pass, PASSWORD_ARGON2I);
        $stmt = $this->db->prepare("INSERT INTO `users` (`emailcim`, `igazolvanyszam`, `name`, `password`) VALUES (?, ?, ?, ?);");
        $stmt->bind_param("ssss", $emailcim, $igazolvanyszam, $name, $pass);
        if ($stmt->execute()) {
            $_SESSION['login'] = true;
            header("location: index.php");
        }
    }
}
