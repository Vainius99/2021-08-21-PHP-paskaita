<?php

require_once ("prijungimas.php");

?>
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
<?php if($varT[3] != 3 ) { ?>

    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
        </nav>
        <h1>Klientu pridejimas</h1>
        <form action="klientupildymoforma.php" method="get">
            <div class="form-group">
                <label for="vardas"> Vardas </label>
                <input class="form-control" type="text" value="test" name="vardas"/>
            </div>
            <div class="form-group">
                <label for="pavarde"> Pavarde </label>
                <input class="form-control" type="text" value="test" name="pavarde"/>
            </div>
            <div class="form-group">
                <label for="teises_id"> Teises </label>
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
                <!-- <label for="imones_id"> Imones ID </label> -->
                <!-- <input type="text" value="5" name="imones_id"/> -->
            <div class="form-group">
                <div class="col-lg-12">
                        <label for="aprasymas">Aprasymas</label>
                        <textarea class="form-control" type="text" id="aprasymas" name="aprasymas"></textarea>
                </div>
            </div>
                <!-- <label for="prisijungimo_data"> Prisijungimo data </label>
                <input type="text" value="5" name="prisijungimo_data"/> -->
            <button class="btn btn-success" type="submit" name="prideti">prideti nauja klienta</button>
            <a href="klientai.php">Back</a> 
        </form>
    </div> 
<?php

if(isset($_GET["prideti"])) {
 
    if(isset($_GET["vardas"]) && !empty($_GET["vardas"]) && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) && isset($_GET["teises_id"]) && !empty($_GET["teises_id"]) && isset($_GET["aprasymas"]) && !empty($_GET["aprasymas"])) {
       
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = $_GET["teises_id"];
        $aprasymas = $_GET["aprasymas"];
        $laikas = time();
            if (is_numeric($teises_id)) {

                $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`, `aprasymas`, `imones_id`, `pridejimo_data` ) VALUES ('$vardas','$pavarde', $teises_id, '$aprasymas', 1, CURRENT_TIMESTAMP)";

                    if (mysqli_query($prisijungimas, $sql)){
                        
                        $last_id = mysqli_insert_id($prisijungimas);
                        $message = "PAPILDYTA: ID = ".$last_id.", Vardas = ".$vardas.", Pavarde = ".$pavarde.", Teises numeris = ".$teises_id.", Aprasymas = ". $aprasymas.", Pridejimo laikas = ". $laikas;
                        $class= "success";
                      
                    } else 
                    $negerai = "Kazkas ivyko negerai";
                    $classN= "danger";
            } else 
            $negerai = "Teises id neskaicius";
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
<?php } else { 
        echo "Error 404";
        echo "<br>";
        echo "<a href='klientai.php'>Back</a>"; } ?> 
        
        <script>
            $(document).ready(function() {
            $('#aprasymas').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                });
            });

        </script>


<?php mysqli_close($prisijungimas); ?>
    
</body>
</html>