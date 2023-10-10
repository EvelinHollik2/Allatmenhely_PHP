<?php
if (filter_input(INPUT_POST, 'regisztraciosAdatok', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $pass1 = filter_input(INPUT_POST, "password");
    $pass2 = filter_input(INPUT_POST, "password2");
    $name = htmlspecialchars(filter_input(INPUT_POST, 'username'));
    if ($pass1 != $pass2) {
        echo '<p>Nem egyeznek a jelszavak!</p>';
    } else {
        //-- regisztráció indítása
        $db->register($name, $pass1);
        header("Location: index.php");
    }
}
?>
<div class="container">
    <form action="#" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Felhasználó név</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password2" class="form-label">Jelszó megerősítés</label>
            <input type="password" class="form-control" id="password2" name="password2">
        </div>
        <button type="submit" class="btn btn-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
    </form>
</div>