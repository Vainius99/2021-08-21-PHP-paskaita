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
    if($varT[3] != 3 ) {
        if(isset($_GET["trinti"])){
            $id= $_GET["trinti"];
            
            $sql = ("DELETE FROM `imones` WHERE `ID` = $id;");
                if (mysqli_query($prisijungimas, $sql)){
            $message = "imone sekmingai istrinta";
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
                <form class="form-inline" action="imones.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Imoniu paieska" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
                        <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
                        <a class="btn btn-primary" href="imones.php"> Išvalyti paiešką</a>
                        <?php } ?>
                </form>
            </div>
            <div class="col-lg-4 col-md-3">
            <form action="imones.php" method="get">
            <select class="form-control" name="rikiavimas_id">
            <?php if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"]) && $_GET["rikiavimas_id"] != "ASC") {?>
                    <option value="DESC" selected="true"> Nuo didžiausio iki mažiausio</option>
                    <option value="ASC"> Nuo mažiausio iki didžiausio</option>
                    <?php } else { ?>
                    <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                    <option value="ASC" selected="true"> Nuo mažiausio iki didžiausio</option>
                    <?php } ?>
            </select>
            <select class="form-control" name="filtravimas">
                <?php if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {?>
                    <option value="default">Rodyti visus</option>
                <?php } else { ?>
                    <option value="default" selected="true">Rodyti visus</option>
                <?php } ?>
                    <?php 
                         $sql = "SELECT * FROM imones_tipas";
                         $result = $prisijungimas->query($sql);
                        
                         while($imonesTipas = mysqli_fetch_array($result)) {
                            if(isset($_GET["filtravimas"]) && $_GET["filtravimas"] == $imonesTipas["ID"] ) {  
                                echo "<option value='".$imonesTipas["ID"]."' selected='true'>";
                            } else { 
                                echo "<option value='".$imonesTipas["ID"]."'>";
                            }
                                echo $imonesTipas["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary" type="submit" name="filtruoti">Filtras</button>
            </form>
        </div>     
    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Pavadinimas</th>
                    <th scope="col">Tipas</th>
                    <th scope="col">Aprasymas</th>
                    <th scope="col"><?php if($varT[3] != 3 ) { echo "Veiksmai"; } ?></th>
                </tr>
            </thead>
        <tbody>
<?php

    if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {
        $filtravimas = "imones.tipas_id = ".$_GET["filtravimas"];
    } else {
        $filtravimas = 1;
    }

    if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
        $rikiavimas = $_GET["rikiavimas_id"];
    } else {
        $rikiavimas = "DESC";
    }

$sql = "SELECT imones.ID, imones.pavadinimas AS pavadinimas1, imones_tipas.pavadinimas AS pavadinimas2, imones.aprasymas
FROM `imones` 
LEFT JOIN  `imones_tipas` ON imones.tipas_id = imones_tipas.ID
WHERE $filtravimas
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
        if($varT[3] != 3 ) {
        echo "<a href='imonesEdit.php?ID=".$imones["ID"]."'>Redaguoti</a>";
        echo " ";
        echo "<a class= 'red' href='imones.php?trinti=".$imones["ID"]."'>Trinti</a>";
        }
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


<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>