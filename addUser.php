<?php require_once ("prijungimas.php"); ?>

<?php 

$vardas = $_GET["vardas"];
$pavarde = $_GET["pavarde"];
$username = $_GET["username"];
$teises_id = intval($_GET["teises_id"]);


//MEs galime daryt ka norim t.y vykdyti INSERT sql uzklausa

$sql = "INSERT INTO `vartotojai`(`vardas`, `pavarde`, `username`, `teises_id`, `password`, `registracijos_data`, `paskutinis_prisijungimas`) VALUES ('$vardas','$pavarde','$username','$teises_id','$username',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
if(mysqli_query($prisijungimas, $sql)) {

    echo '<div class="alert alert-success" role="alert">';
        echo "Vartotojas ".$username." pridėta sėkmingai";        
    echo '</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">';
        echo "Kazkas ivyko negerai. Uzklausa nesekminga";
    echo '</div>';    
}
// neperduoda iskarto
?>
