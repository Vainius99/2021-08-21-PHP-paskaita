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
        form {
        margin-top: 24px;
    }
        .red {
            color: red;
        }
        </style>
         <?php require_once("priedai.php"); ?>
</head>
<body>
<?php require_once("prsijunges.php"); ?>    
        <?php
        // if(isset($_GET["trinti"])){
        //     $id= $_GET["trinti"];
            
        //     $sql = ("DELETE FROM `imones` WHERE `ID` = $id;");
        //         if (mysqli_query($prisijungimas, $sql)){
        //     $message = "imone sekmingai istrinta";
        //     $class = "success";
        //         } else 
        //             $negerai = "Kazkas negerai";
        //             $classN = "danger";
        // }
        ?>
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
    </div>
    <form class="form-inline" action="imones.php" method="get">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Imoniu paieska" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
  </form>
  </nav>

  <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
    <a class="btn btn-primary" href="imones.php"> Išvalyti paiešką</a>
    <?php } ?>

    <form action="imones.php" method="get">

        <div class="form-group">
            <select class="form-control" name="rikiavimas_id">
                <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                <option value="ASC"> Nuo mažiausio iki didžiausio</option>
            </select>
            <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
        </div>
    </form>    

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Pavadinimas</th>
      <th scope="col">Tipas</th>
      <th scope="col">Aprasymas</th>
      <th scope="col">Veiksmas</th>

    </tr>
  </thead>
  <tbody>
<?php

    if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC";
    }

$sql = "SELECT imones.ID, imones.pavadinimas AS pavadinimas1, imones_tipas.pavadinimas AS pavadinimas2, imones.aprasymas
FROM `imones` 
LEFT JOIN  `imones_tipas` ON imones.tipas_id = imones_tipas.ID
WHERE 1
ORDER BY imones.ID $rikiavimas";

if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
    $sql ="SELECT imones.ID, imones.pavadinimas AS pavadinimas1, imones_tipas.pavadinimas AS pavadinimas2, imones.aprasymas
    FROM `imones` 
    LEFT JOIN  `imones_tipas` ON imones.tipas_id = imones_tipas.ID
    WHERE imones.pavadinimas LIKE '%".$search."%'
    ORDER BY imones.ID $rikiavimas";;
}

$rezultatas = $prisijungimas->query($sql);

while($imones = mysqli_fetch_array($rezultatas)) {
    echo "<tr>";
        echo "<td>". $imones["ID"]."</td>";
        echo "<td>". $imones["pavadinimas1"]."</td>";
        echo "<td>". $imones["pavadinimas2"]."</td>";
        echo "<td>". $imones["aprasymas"]."</td>";
        echo "<td>";
        echo "<a href='imonesEdit.php?ID=".$imones["ID"]."'>Redaguoti</a>";
        echo " ";
        echo "<a class= 'red' href='imones.php?trinti=".$imones["ID"]."'>Trinti</a>";
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

<!-- delete ? -->
<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>