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
        h1 {
            text-align: center;
        }
        .hide {
            display:none;
        }
    </style>

</head>
<body>
<?php require_once("prsijunges.php"); ?>
<?php if($varT[3] != 3) { ?>

<?php
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM `imones` WHERE `ID` = $id";
    // $result = $prisijungimas->query($sql); 
    $result = mysqli_query($prisijungimas, $sql);
    // var_dump($result);

    if($result->num_rows == 1) {
        $imones = mysqli_fetch_array($result);
    
        $hideForm = false;
    } else {
        echo "ivyko kazkas blogai";
        $hideForm = true;
    }

}
if(isset($_GET["submit"])) {
    if(isset($_GET["pavadinimas"]) && isset($_GET["tipas_id"]) && !empty($_GET["pavadinimas"]) && !empty($_GET["tipas_id"])) {
        $id = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $tipas_id = intval($_GET["tipas_id"]);
        $aprasymas = $_GET["aprasymas"];

        $sql = "UPDATE `imones` SET `pavadinimas`='$pavadinimas',`tipas_id`= $tipas_id ,`aprasymas`= '$aprasymas'  WHERE ID = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Imone redaguota sėkmingai (Po 5 sekundziu griste i Imoniu valdyma)";
            $class = "success";
            $hideForm = true;           
           
            echo '<meta http-equiv="refresh" content="5;url=imones.php">';

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
            <h1>Imones redagavimas</h1>
            <form action="imonesEdit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $imones["ID"] ?>" />

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" value="<?php echo $imones["pavadinimas"] ?>" />
                </div>
                <div class="form-group">
                    <label for="tipas_id">Tipas</label>
                    <select class="form-control" name="tipas_id">
                    <?php 
                         $sql = "SELECT * FROM `imones_tipas`";
                         $result = $prisijungimas->query($sql);
                        
                         while($imonesTipas = mysqli_fetch_array($result)) {

                            if($imones["tipas_id"] == $imonesTipas["ID"] ) {
                                echo "<option value='".$imonesTipas["ID"]."' selected='true'>";
                            }  else {
                                echo "<option value='".$imonesTipas["ID"]."'>";
                            }  
                                echo $imonesTipas["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprasymas</label>
                    <input class="form-control" type="text" name="aprasymas" value="<?php echo $imones["aprasymas"] ?>"/>
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Issaugoti</button>
                <br>
                <a href="imones.php">Back</a> 
               
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
        echo "Error 404";
        echo "<br>";
        echo "<a href='imones.php'>Back</a>";  } ?> 
   
    <?php mysqli_close($prisijungimas); ?> 
</body>
</html>