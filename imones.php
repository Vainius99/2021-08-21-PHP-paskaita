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
        
        .red {
            color: red;
        }
     
        </style>
    
   
</head>
<body>
<?php 
        if(!isset($_COOKIE["login"])) { 
            header("Location: index.php");    
        } else {
            echo "<form action='klientai.php' method ='get'>";
            echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
            echo "</form>";
            if(isset($_GET["logout"])) {
                setcookie("login", "", time() - 3600, "/");
                header("Location: index.php");
            }
        }    
        
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
        
        ?>
    
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
    </div>

    <form action="imones.php" method="get">

        <div class="form-group">
            <select class="form-control" name="rikiavimas_id">
                <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                <option value="ASC"> Nuo mažiausio iki didžiausio</option>
            </select>
            <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
        </div>

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

$sql = "SELECT * FROM `klientai` ORDER BY `ID` $rikiavimas";


// if(isset($_GET["search"]) && !empty($_GET["search"])) {
//     $search = $_GET["search"];
//     $sql = "SELECT * FROM `klientai` WHERE `vardas` LIKE '%".$search."%' OR `pavarde` LIKE '%".$search."%' ORDER BY `ID` $rikiavimas";
// }

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

$sql = "SELECT * FROM `imones` WHERE 1";

$rezultatas = $prisijungimas->query($sql);


while($imones = mysqli_fetch_array($rezultatas)) {
    echo "<tr>";
        echo "<td>". $imones["ID"]."</td>";
        echo "<td>". $imones["pavadinimas"]."</td>";
        echo "<td>". $imones["tipas_id"]."</td>";
        echo "<td>". $imones["aprasymas"]."</td>";
        echo "<td>";
        // echo "<a href='imonesEdit.php?ID=".$imones["ID"]."'>Redaguoti</a>";
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

<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>