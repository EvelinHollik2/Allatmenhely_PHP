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
            var_dump($row, $pass);
            if ($pass == $row['password']) {
                //-- felhasználónév és jelszó helyes
                $_SESSION['username'] = $row['name'];
                $_SESSION['login'] = true;
                return true;
            }
        } else {
            $_SESSION['username'] = '';
            $_SESSION['login'] = false;
            return false;
        }
        // Free result set
        $result->free_result();
        return false;
    }

    /* email ellenörző @ */

    public function register($igazolvanyszam, $orokbefogado_neve, $email, $name, $pass) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`userid`, `igazolvanyszam`, `orokbefogado_neve`, `emailcim`, `name`, `password`) VALUES (NULL,?,?,?,?,?)");

        if (!$stmt) {
            die('Error: ' . $this->db->error);
        }

        $stmt->bind_param("sssss", $igazolvanyszam, $orokbefogado_neve, $email, $name, $pass);

        try {
            if ($stmt->execute()) {
                $_SESSION['login'] = true;
                header("location: index.php");
            }
        } catch (Exception $e) {

            echo 'Error: ' . $e->getMessage();
        }
    }

    function osszesAllat() {
        $result = $this->db->query("SELECT * FROM `allat`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function kivalasztottAllat($id) {
        $result = $this->db->query("SELECT * FROM `allat`WHERE allatid=" . $id);
        return $result->fetch_assoc();
    }
}
