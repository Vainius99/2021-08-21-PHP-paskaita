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
            echo "Sveikas prisijunges";
            echo "<form action='klientai.php' method ='get'>";
            echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
            echo "</form>";
            if(isset($_GET["logout"])) {
                setcookie("login", "", time() - 3600, "/");
                header("Location: index.php");
            }
        }    
        ?>
    
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
    </div>

    <!-- <form action="klientai.php" method="get">

        <div class="form-group">
            <select class="form-control" name="rikiavimas_id">
                <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                <option value="ASC"> Nuo mažiausio iki didžiausio</option>
            </select>
            <button class="btn btn-primary" name="rikiuoti" type="submit">Rikiuoti</button>
        </div>
    </form> -->
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Vardas</th>
      <th scope="col">Pavardė</th>
      <th scope="col">Teisės</th>
      <th scope="col">Aprasymas</th>
      <th scope="col">Imones ID</th>
      <th scope="col">Pridejimo data</th>
      <th scope="col">Veiksmai</th>
    </tr>
  </thead>
  <tbody>
<?php

// if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
//     $rikiavimas = $_GET["rikiavimas_id"];
// } else {
//     $rikiavimas = "DESC";
// }

// $sql = "SELECT * FROM `klientai` ORDER BY `ID` DESC";


// if(isset($_GET["search"]) && !empty($_GET["search"])) {
//     $search = $_GET["search"];
//     $sql = "SELECT * FROM `klientai` WHERE `vardas` LIKE '%".$search."%' OR `pavarde` LIKE '%".$search."%' ORDER BY `ID` $rikiavimas";
// }

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

$sql = "SELECT * FROM `klientai` WHERE 1";

$rezultatas = $prisijungimas->query($sql);


while($klientai = mysqli_fetch_array($rezultatas)) {
    echo "<tr>";
        echo "<td>". $klientai["ID"]."</td>";
        echo "<td>". $klientai["vardas"]."</td>";
        echo "<td>". $klientai["pavarde"]."</td>";
        echo "<td>". $klientai["teises_id"]."</td>";
        echo "<td>". $klientai["aprasymas"]."</td>";
        echo "<td>". $klientai["imones_id"]."</td>";
        echo "<td>". $klientai["pridejimo_data"]."</td>";
        echo "<td>";
        echo "<a href='klientaiEdit.php?ID=".$klientai["ID"]."'>Redaguoti</a>";
        echo " ";
        echo "<a class= 'red' href='klientai.php?trinti=".$klientai["ID"]."'>Trinti</a>";
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