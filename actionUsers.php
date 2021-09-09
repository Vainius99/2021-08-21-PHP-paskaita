<?php require_once ("prijungimas.php"); ?>

<?php 

echo '<table class="table table-striped">';
              
                
    // $sql = "SELECT imones.ID, imones.pavadinimas AS imones_pavadinimas, imones.aprasymas AS imones_aprasymas, imones_tipas.pavadinimas AS imones_tipas_pavadinimas, imones_tipas.aprasymas AS imones_tipas_aprasymas 
    // FROM `imones` 
    // LEFT JOIN imones_tipas ON imones.tipas_ID = imones_tipas.ID 
    // WHERE 1 
    // ORDER BY imones.ID DESC";

$sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE 1

";

$rezultatas = $prisijungimas->query($sql);

while($vartotojai = mysqli_fetch_array($rezultatas)) {
    echo "<tr>";
        echo "<td>". $vartotojai["ID"]."</td>";
        echo "<td>". $vartotojai["vardas"]."</td>";
        echo "<td>". $vartotojai["pavarde"]."</td>";
        echo "<td>". $vartotojai["username"]."</td>";
        echo "<td>". $vartotojai["pavadinimas"]."</td>";
        echo "<td>". $vartotojai["registracijos_data"]."</td>";
        echo "<td>". $vartotojai["paskutinis_prisijungimas"]."</td>";
        echo "<td>";
     if($varT[3] == 1 ) {
        echo "<a href='vartotojaiEdit.php?ID=".$vartotojai["ID"]."'>Redaguoti</a>";
     }
        if($varT[3] == 4 || $varT[3] == 1 ) {
        echo " ";
        echo "<a class= 'red' href='vartotojai.php?trinti=".$vartotojai["ID"]."'>Trinti</a>";
     }
    echo "</td>";  
    echo "</tr>";
}



// neperduoda iskarto
                
            



?>