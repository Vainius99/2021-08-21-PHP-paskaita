<?php require_once ("prijungimas.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php require_once("priedai.php"); ?>

    <style>
        .container {
            margin-bottom: 20px;
        }
        form {
        margin-top: 24px;
    }
        .red {
            color: red;
        }
        </style>
</head>
<body>
<?php require_once("prsijunges.php"); ?>

<?php
if(isset($_GET["trinti"])){
    $id= $_GET["trinti"];
    
    $sql = ("DELETE FROM `vartotojai` WHERE `ID` = $id;");
        if (mysqli_query($prisijungimas, $sql)){
    $message = "Vartotojas sekmingai istrintas";
    $class = "success";
        } else 
            $negerai = "Kazkas negerai";
            $classN = "danger";
}
?>  
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
        </nav>
        <div class="row">
            <div class="col-lg-4 col-md-3">
                <form class="form-inline" action="vartotojai.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Vartotoju paieska" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
                        <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
                        <a class="btn btn-primary" href="vartotojai.php"> Išvalyti paiešką</a>
                        <?php } ?>
                </form>
            </div>
            <div class="col-lg-4 col-md-3">
            <form action="vartotojai.php" method="get">
            <select class="form-control" name="filtravimas">
                <?php if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {?>
                    <option value="default">Rodyti visus</option>
                <?php } else { ?>
                    <option value="default" selected="true">Rodyti visus</option>
                <?php } ?>
                    <?php 
                         $sql = "SELECT * FROM vartotojai_teises";
                         $result = $prisijungimas->query($sql);
                        
                         while($userRights = mysqli_fetch_array($result)) {
                            if(isset($_GET["filtravimas"]) && $_GET["filtravimas"] == $userRights["reiksme"] ) {  
                                echo "<option value='".$userRights["reiksme"]."' selected='true'>";
                            } else { 
                                echo "<option value='".$userRights["reiksme"]."'>";
                            }
                                echo $userRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary" type="submit" name="filtruoti">Filtras</button>
            </form>
        </div>
            <div class="col-lg-4 col-md-3">  
                <form action="vartotojai.php" method="get">
                    <div class="form-group">
                        <select class="form-control" name="rikiavimas_id">
                            <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                            <option value="ASC"> Nuo mažiausio iki didžiausio</option>
                        </select>
                        <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiavimas</button>
                    </div>
                </form>
            </div>
        </div>

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Vardas</th>
      <th scope="col">Pavardė</th>
      <th scope="col">Slapyvardis</th>
      <th scope="col">Teises</th>
      <th scope="col">Registracijos data</th>
      <th scope="col">Paskutinis prisijungimas</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>
  <tbody>

<?php

if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {
    $filtravimas = "vartotojai.teises_id = ".$_GET["filtravimas"];
} else {
    $filtravimas = 1;
}

if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
    $rikiavimas = $_GET["rikiavimas_id"];
} else {
    $rikiavimas = "DESC";

}

$sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE $filtravimas
ORDER BY vartotojai.ID $rikiavimas";

if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE vartotojai.vardas LIKE '%".$search."%' OR vartotojai.pavarde LIKE '%".$search."%' OR vartotojai.username LIKE '%".$search."%' OR vartotojai_teises.pavadinimas LIKE '%".$search."%'
ORDER BY vartotojai.ID $rikiavimas";
}

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
            echo "<a href='vartotojaiEdit.php?ID=".$vartotojai["ID"]."'>Redaguoti</a>";
            echo " ";
            echo "<a class= 'red' href='vartotojai.php?trinti=".$vartotojai["ID"]."'>Trinti</a>";
        echo "</td>";  
        echo "</tr>";
    
    }

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

<!-- paskutinis prisijungimas -->
<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>