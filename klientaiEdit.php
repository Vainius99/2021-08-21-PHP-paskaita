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
            margin-bottom: 24px;
        }
        h1 {
            text-align: center;
        }
        .hide {
            display:none;
        }
        form {
        margin-top: 24px;
    }
    </style>

</head>
<body>
<?php require_once("prsijunges.php"); ?>
<?php if($varT[3] != 3) { ?>
<?php
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM `klientai` WHERE `ID` = $id";
    // $result = $prisijungimas->query($sql); 
    $result = mysqli_query($prisijungimas, $sql);
    // var_dump($result);

    if($result->num_rows == 1) {
        $klientas = mysqli_fetch_array($result);
        $hideForm = false;
    } else {
        echo "ivyko kazkas blogai";
        $hideForm = true;
    }
}
if(isset($_GET["submit"])) {
    if(isset($_GET["vardas"]) && isset($_GET["pavarde"]) && isset($_GET["teises_id"]) && isset($_GET["aprasymas"])  && !empty($_GET["vardas"]) && !empty($_GET["pavarde"]) && !empty($_GET["teises_id"]) && !empty($_GET["aprasymas"])) {
        $id = $_GET["ID"];
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = intval($_GET["teises_id"]);
        $aprasymas = $_GET["aprasymas"];

        $sql = "UPDATE `klientai` SET `vardas`='$vardas',`pavarde`='$pavarde',`teises_id`= $teises_id ,`aprasymas`= '$aprasymas'  WHERE ID = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Klientas redaguotas sėkmingai (Po 5 sekundziu griste i Klientu valdyma)";
            $class = "success";
            $hideForm = true;           
            // header("Refresh:5; url=klientai.php");
            echo '<meta http-equiv="refresh" content="5;url=klientai.php">';

        } else {
            $negerai =  "Kazkas ivyko negerai";
            $classN = "danger";
        }
    } else {
        $negerai =  "Kazkas ivyko negerai arba yra tusti langeliai";
        $classN = "danger";
    }
}
?>
<div class="container">
<?php require_once("priedai/menu.php"); ?>
</nav>
    <?php if($hideForm == false) { ?>
            <h1>Kliento redagavimas</h1>
            <form action="klientaiEdit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $klientas["ID"] ?>" />

                <div class="form-group">
                    <label for="vardas">Vardas</label>
                    <input class="form-control" type="text" name="vardas" value="<?php echo $klientas["vardas"] ?>" />
                </div>
                <div class="form-group">
                    <label for="pavarde">Pavardė</label>
                    <input class="form-control" type="text" name="pavarde" value="<?php echo $klientas["pavarde"] ?>"/>
                </div>
                <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <select class="form-control" name="teises_id">
                    <?php 
                         $sql = "SELECT * FROM klientai_teises";
                         $result = $prisijungimas->query($sql);
                        
                         while($clientRights = mysqli_fetch_array($result)) {

                            if($klientas["teises_id"] == $clientRights["reiksme"] ) {
                                echo "<option value='".$clientRights["reiksme"]."' selected='true'>";
                            }  else {
                                echo "<option value='".$clientRights["reiksme"]."'>";
                            }   
                                echo $clientRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprasymas</label>
                    <input class="form-control" type="text" name="aprasymas" value="<?php echo $klientas["aprasymas"] ?>"/>
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Issaugoti</button>
                <br>
                <a href="klientai.php">Back</a> 
               
            </form>

        <?php } else { ?>
            
        <?php } ?>  

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
    </div>
   
    <?php } else { 
        echo "Neturite tam teises"; 
        echo "<br>";
        echo "<a href='klientai.php'>Back</a>"; } ?>    
    <?php mysqli_close($prisijungimas); ?> 
</body>
</html>