<?php

$duomenu_bazes_serveris = "localhost";
$duomenu_bazes_slapyvardis = "root";
$duomenu_bazes_slaptazodis = "";
$duomenu_bazes_pavadinimas = "klientu_valdymas";

$prisijungimas = mysqli_connect($duomenu_bazes_serveris,$duomenu_bazes_slapyvardis,$duomenu_bazes_slaptazodis, $duomenu_bazes_pavadinimas);

if ($prisijungimas == false) {
    die("nepavyko prisijungti prie duomenu bazes".mysqli_connect_error());
}  else {
        echo "prisijungta sekmingai";
        echo "<br>";
       
    }

?>