<?php require_once ("prijungimas.php"); ?>

<?php 

$vardas = $_GET["vardas"];
$pavarde = $_GET["pavarde"];
$username = $_GET["username"];
$password = $_GET["password"];

$sql = "INSERT INTO `vartotojai`(`vardas`, `pavarde`, `username`, `teises_id`, `password`, `registracijos_data`, `paskutinis_prisijungimas`) VALUES ('$vardas','$pavarde','$username',3 ,'$password',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
if(mysqli_query($prisijungimas, $sql)) {

    echo '<div class="message alert alert-success" role="alert">';
        echo "Vartotojas $username pridėtas sėkmingai";        
    echo '</div>';
} else {
    echo '<div class="message alert alert-danger" role="alert">';
        echo "Kazkas ivyko negerai. Uzklausa nesekminga";
    echo '</div>';    
}

?>
