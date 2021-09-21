<?php require_once ("prijungimas.php"); ?>
<?php if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");
    } else {
        $varT = explode("|", $_COOKIE["login"]);
    }
?>

<?php 

echo '<table class="table table-striped">';

                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">ID</th>';
                echo '<th scope="col">Vardas</th>';
                echo '<th scope="col">Pavardė</th>';
                echo '<th scope="col">Slapyvardis</th>';
                echo '<th scope="col">Teises</th>';
                echo '<th scope="col">Registracijos data</th>';
                echo '<th scope="col">Paskutinis prisijungimas</th>';
                if($varT[3] == 4 || $varT[3] == 1 ) { 
                    echo '<th scope="col">Veiksmai</th>'; 
                }
                echo  '</tr>';
                echo '</thead>';
              
$sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE 1
ORDER BY vartotojai.ID DESC
";
// $sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
// FROM `vartotojai` 
// LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
// WHERE 1
// ORDER BY DESC";
// $resultatas = mysqli_query($prisijungimas,$sql);
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

echo '</tbody>';
echo '</table>';


                
            



?>