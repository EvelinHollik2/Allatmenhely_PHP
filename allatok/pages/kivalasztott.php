<?php
if (filter_input(INPUT_POST, "Adatmodositas", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    var_dump($_FILES);
    if ($_FILES['kepfajl']['error']==0) {
        $kiterjesztes=null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes=".png";
                break;
            case 'image/jpeg':
                $kiterjesztes=".jpg";
                break;
            default:
                break;
        }
        $forras=$_FILES['kepfajl']['tmp_name'];
        $cel=DIRECTORY_SEPARATOR. "allatkepek".DIRECTORY_SEPARATOR.$adatok['allat_neve'].$kiterjesztes;
        copy($forras, $cel);
    }
} else {
    echo 'Nem kaptunk adatokat!';
    $adatok = $db->kivalasztottAllat($id);
}
?>

<form method="post" action="index.php?menu=home&id=<?php echo $adatok['allatid'];?>" enctype="multipart/form-data">
    <input type="hidden" name="allatid" value="<?php echo $adatok['allatid']; ?>">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Állat neve</label>
        <input type="text" class="form-control" name="allat_neve" id="allat_neve" value="<?php echo $adatok['allat_neve']; ?>">
    </div>

    <div class="row">
        <div class="mb-3 col-6">
            <label for="fajSelect" class="form-label">Állatfaj</label>
            <select id="fajSelect" name="fajSelect" class="form-select">
<?php
foreach ($db->getFajok() as $value) {
    if ($adatok['faj'] == $value[0]) {
        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
    } else {
        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
    }
}
?>
            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="fajtaSelect" class="form-label">Állatfajta</label>
            <select id="fajtaSelect" name="fajSelect" class="form-select">
<?php
foreach ($db->getFajtak() as $value) {
    if ($adatok['fajta'] == $value[0]) {
        echo '<option selected value="' . $value[0] . '">' . $value[0] . '</option>';
    } else {
        echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
    }
}
?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-6"
             <label for="szuletesi_ido" class="form-label">Születési idő</label>
            <input type="date" class="form-control" name="szuletesi_ido" id="szuletesi_ido" max="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="nem" class="form-label">Állat neme</label>
            <select id="nemSelect" name="nemSelect" class="form-select">
                <option value="kan">kan</option>';
                <option value="szuka">szuka</option>';
            </select>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-6"
             <label for="nyilvantartasban" class="form-label">Nyilvántartásba véve</label>
            <input type="date" class="form-control" name="nyilvantartasban" id="nyilvantartasban" max="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="megjegyzes" class="form-label">Megjegyzés</label>
            <input type="text" class="form-control" name="megjegyzes" id="megjegyzes" value="<?php echo $adatok['megjegyzes']; ?>">
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>
    </div>
    <button type="submit" class="btn btn-success" value="1" name="Adatmodositas">Adatmódosítás</button>
</form>