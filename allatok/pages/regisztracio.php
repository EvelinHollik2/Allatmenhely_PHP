<?php
if (filter_input(INPUT_POST, 'regisztraciosAdatok', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $pass1 = filter_input(INPUT_POST, "password");
    $pass2 = filter_input(INPUT_POST, "password2");
    $name = htmlspecialchars(filter_input(INPUT_POST, 'name'));
    $emailcim = filter_input(INPUT_POST, "emailcim", FILTER_VALIDATE_EMAIL);
    $orokbefogado_neve = filter_input(INPUT_POST, "orokbefogado_neve");
    $igazolvanyszam = filter_input(INPUT_POST, "igazolvanyszam");
    if ($pass1 != $pass2) {
        echo '<p>Nem egyeznek a jelszavak!</p>';
    } else {
        //-- regisztráció indítása
        $db->register($orokbefogado_neve, $emailcim, $igazolvanyszam, $name, $pass1);
        header("Location: index.php");
    }
}
?>
<div class="container">
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="emailcim" class="form-label">Email cím</label>
                    <input type="email" class="form-control" id="emailcim" name="emailcim" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="orokbefogado_neve" class="form-label">Teljes név</label>
                    <input type="text" class="form-control" id="orokbefogado_neve" name="orokbefogado_neve" minlength="3" maxlength="50" aria-describedby="teljesnevHelp" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="mb-3">
                <label for="igazolvanyszam" class="form-label">Igazolványszám</label>
                <input type="text" class="form-control" id="igazolvanyszam" name="igazolvanyszam" pattern="[1-9]{1}[0-9]{5}[A-Za-z}{2}" aria-describedby="igazolvanyszamHelp">
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Felhasználó név</label>
            <input type="text" class="form-control" id="name" name="name" minlength="3" maxlength="50" aria-describedby="felhasznalonevHelp">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password2" class="form-label">Jelszó megerősítés</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
    </form>
</div>