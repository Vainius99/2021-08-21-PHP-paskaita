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
    h1 {
        text-align: center;
        }
    form {
        margin-top: 24px;
    }
    .message {
        text-align: center;
    }   
    </style>
<?php require_once("priedai.php"); ?>

</head>
<body>
<?php require_once("prsijunges.php"); ?>
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
        </nav>
        <h1>Imones pridejimas</h1>
        <form action="imonespildymoforma.php" method="get">
            <div class="form-group">
                <label for="pavadinimas"> Pavadinimas </label>
                <input class="form-control" type="text" value="test" name="pavadinimas"/>
            </div>
            <div class="form-group">
                <label for="tipas_id"> Tipas </label>
                <select class="form-control" name="tipas_id">
                    <?php 
                         $sql = "SELECT * FROM imones_tipas";
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
                <label for="aprasymas"> Aprasymas </label>
                <input class="form-control" type="text" value="test" name="aprasymas"/>
            </div>
            <button class="btn btn-success" type="submit" name="prideti">prideti nauja klienta</button>
            <a href="imones.php">Back</a> 
        </form>
    </div> 

<?php

if(isset($_GET["prideti"])) {
 
    if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["tipas_id"]) && !empty($_GET["tipas_id"]) && isset($_GET["aprasymas"]) && !empty($_GET["aprasymas"])) {
       
        $pavadinimas = $_GET["pavadinimas"];
        $tipas_id = $_GET["tipas_id"];
        $aprasymas = $_GET["aprasymas"];
                $sql = "INSERT INTO `imones`(`pavadinimas`, `tipas_id`, `aprasymas`) VALUES ('$pavadinimas', $tipas_id, '$aprasymas')";
                    if (mysqli_query($prisijungimas, $sql)){
                        
                        $last_id = mysqli_insert_id($prisijungimas);
                        $message = "PAPILDYTA: ID = ".$last_id.", Pavadinimas = ".$pavadinimas.", Tipas = ".$tipas_id.", Aprasymas = ". $aprasymas;
                        $class= "success";
                      
                    } else 
                    $negerai = "Kazkas ivyko negerai";
                    $classN= "danger";       
    } else 
            $negerai = "Langeliai tusti arba kazkas negerai";
            $classN= "danger";
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

<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>