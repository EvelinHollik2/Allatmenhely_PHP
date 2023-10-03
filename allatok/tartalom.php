<?php
if ($_SESSION['login']) {
    echo $_SESSION['username'].' belépett ';
} else {
    require_once './pages/login.php';
}
