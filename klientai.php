<?php require_once ("prijungimas.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .container {
            margin-bottom: 20px;
        }
        .red {
            color: red;
        }
        form {
        margin-top: 24px;
    } 
        </style>
        <?php require_once("priedai.php"); ?>
</head>
<body>
<div class="container">
    <div class="row">
    <?php require_once("prsijunges.php"); ?>
    </div>
</div> 
<?php
if($varT[3] != 3 ) {
if(isset($_GET["trinti"])){
    $id= $_GET["trinti"];
    
    $sql = ("DELETE FROM `klientai` WHERE `ID` = $id;");
        if (mysqli_query($prisijungimas, $sql)){
    $message = "Klientas sekmingai istrintas";
    $class = "success";
        } else 
            $negerai = "Kazkas negerai";
            $classN = "danger";
    }
}
?>  
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
  </nav>
    <div class="row">
        <div class="col-lg-4 col-md-3">
            <form class="form-inline" action="klientai.php" method="get">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Klientu paieska" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
                <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
                <a class="btn btn-primary" href="klientai.php"> Išvalyti paiešką</a>
                <?php } ?>
            </form>
        </div>
        <div class="col-lg-4 col-md-3">
            <form action="klientai.php" method="get">
            <select class="form-control" name="rikiavimas_id">
                
            <?php if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"]) && $_GET["rikiavimas_id"] != "ASC") {?>
                <option value="DESC" selected="true"> Nuo didžiausio iki mažiausio</option>
                <option value="ASC" > Nuo mažiausio iki didžiausio</option>
                <?php } else { ?>
                <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                <option value="ASC" selected="true"> Nuo mažiausio iki didžiausio</option>
                <?php } ?>


<!-- naudoti duomenu baze kiekvienam stulpeliui filtruoti-->



            </select>    
            
            <select class="form-control" name="filtravimas">
                <?php if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {?>
                    <option value="default">Rodyti visus</option>
                <?php } else { ?>
                    <option value="default" selected="true">Rodyti visus</option>
                <?php } ?>
                    <?php 
                         $sql = "SELECT * FROM klientai_teises";
                         $result = $prisijungimas->query($sql);
                        
                         while($clientRights = mysqli_fetch_array($result)) {
                            if(isset($_GET["filtravimas"]) && $_GET["filtravimas"] == $clientRights["reiksme"] ) {  
                                echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                            } else { 
                                echo "<option value='".$clientRights["reiksme"]."'>";
                            }
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                </select>
                <button class="btn btn-primary" type="submit" name="submit">Filtras</button>
            </form>
        </div>   
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">Teisės</th>
                <th scope="col">Aprasymas</th>
                <th scope="col">Pridejimo data</th>
                <th scope="col"> <?php if($varT[3] != 3 ) { echo "Veiksmai"; } ?></th>
            </tr>
        </thead>
    <tbody>
<?php

$client_count = 10;
if(isset($_GET["psl_skaicius"])) {
    $psl_skaicius = $_GET["psl_skaicius"] * $client_count - $client_count;    
} else {
    $psl_skaicius = 0;    
}

if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {
    $filtravimas = "klientai.teises_id = ".$_GET["filtravimas"];
} else {
    $filtravimas = 1;
}

if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
    $rikiavimas = $_GET["rikiavimas_id"];
} else {
    $rikiavimas = "DESC";
}

$sql = "SELECT klientai.ID, klientai.vardas, klientai.pavarde, klientai_teises.pavadinimas, klientai.aprasymas, klientai.pridejimo_data FROM `klientai` 
LEFT JOIN `klientai_teises` ON klientai.teises_id = klientai_teises.reiksme
WHERE $filtravimas
ORDER BY klientai.ID $rikiavimas
LIMIT $psl_skaicius , 10";

if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT klientai.ID, klientai.vardas, klientai.pavarde, klientai_teises.pavadinimas, klientai.aprasymas, klientai.pridejimo_data FROM `klientai` 
LEFT JOIN `klientai_teises` ON klientai.teises_id = klientai_teises.reiksme
WHERE klientai_teises.pavadinimas LIKE '%".$search."%' OR klientai.pavarde LIKE '%$search%' OR klientai.vardas LIKE '%$search%'
ORDER BY klientai.ID $rikiavimas
LIMIT $psl_skaicius , 10";
}

$rezultatas = $prisijungimas->query($sql);

while($klientai = mysqli_fetch_array($rezultatas)) {
    echo "<tr>";
        echo "<td>". $klientai["ID"]."</td>";
        echo "<td>". $klientai["vardas"]."</td>";
        echo "<td>". $klientai["pavarde"]."</td>";
        echo "<td>". $klientai["pavadinimas"]."</td>";
        echo "<td>". $klientai["aprasymas"]."</td>";
        // echo "<td>". $klientai["pavadinimas"]."</td>";
        echo "<td>". $klientai["pridejimo_data"]."</td>";
        echo "<td>";
        if($varT[3] != 3 ) {
        echo "<a href='klientaiEdit.php?ID=".$klientai["ID"]."'>Redaguoti</a>";
        echo " ";
        echo "<a class= 'red' href='klientai.php?trinti=".$klientai["ID"]."'>Trinti</a>";
        }
       echo "</td>";
    echo "</tr>";
}
?>

<?php
        
        $sql = "SELECT CEILING(COUNT(ID)/10), COUNT(ID) FROM klientai WHERE $filtravimas ORDER BY klientai.ID $rikiavimas";
         $result = $prisijungimas->query($sql);
            if($result->num_rows == 1) { 
                $total_pages = mysqli_fetch_array($result);
                for($i = 1; $i <= intval($total_pages[0]); $i++) {

                    echo "<a href='klientai.php?psl_skaicius=$i'>";
                    echo $i;
                    echo " ";
                    echo "</a>";
                    }
                    echo "<p>";
                            echo "Is viso puslapiu: ";
                            echo $total_pages[0];
                            echo "</p>";
                            echo "<p>";
                            echo "Is viso klientu: ";
                            echo $total_pages[1];
                    echo "</p>";
                            }
                            else {
                                echo "Nepavyko suskaiciuoti klientu";
                            }

        // cia su jungti psl su filtru
?>


<?php if(isset($message)) { ?>
    <div class="message alert alert-<?php echo $class; ?>" role="alert">
        <?php echo $message; ?>
    </div>
    <?php } ?>
    <?php if(isset($negerai)) { ?>
    <div class="message alert alert-<?php echo $classN; ?>" role="alert">
        <?php echo $negerai; ?>
    </div>
    <?php } ?>

        </tbody>
    </table>
</div>

<!-- puslapiavimas apjungti su filtrais -->
<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>