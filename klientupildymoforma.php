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
       
    h1 {
            text-align: center;
        }
    form {
        margin-top: 20px;
    }
    .message {
        text-align: center;
    }
         

    </style>

<?php require_once("priedai.php"); ?>

</head>
<body>

<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");    
}
?>
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
        <form action="klientupildymoforma.php" method="get">
            <div class="form-group">
                <label for="vardas"> Vardas </label>
                <input type="text" value="test" name="vardas"/>
                <label for="pavarde"> Pavarde </label>
                <input type="text" value="test" name="pavarde"/>
                <label for="vardas"> Teises ID </label>
                <input type="text" value="5" name="teises_id"/>
            </div>
            <button class="btn btn-success" type="submit" name="prideti">prideti nauja klienta</button>
            <a href="klientai.php">Back</a> 
        </form>
    </div> 

    

<?php

if(isset($_GET["prideti"])) {
 
    if(isset($_GET["vardas"]) && !empty($_GET["vardas"]) && isset($_GET["pavarde"]) && !empty($_GET["pavarde"]) && isset($_GET["teises_id"]) && !empty($_GET["teises_id"])) {
       
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = $_GET["teises_id"];
            if (is_numeric($teises_id)) {

                $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`) VALUES ('$vardas','$pavarde', $teises_id)";
                // $klientas = "SELECT last_insert_id();";

                    if (mysqli_query($prisijungimas, $sql)){
                        
                        $last_id = mysqli_insert_id($prisijungimas);
                        $message = "PAPILDYTA: ID = ".$last_id.", Vardas = ".$vardas.", Pavarde = ".$pavarde.", Teises numeris = ".$teises_id;
                        $class= "success";
                     
                           
                      
                    } else 
                    // $message = "Kazkas ivyko negerai";
                    // $class= "danger";
                    // echo "Kazkas ivyko negerai";
                    $negerai = "Kazkas ivyko negerai";
                    $classN= "danger";
            } else 
            // $message = "Teises id neskaicius";
            // $class= "danger";
            // echo "Teises id neskaicius";
            $negerai = "Teises id neskaicius";
            $classN= "danger";
        
    } else 
            // $message = "Langeliai tusti arba kazkas negerai";
            // $class= "danger";
            // echo "Langeliai tusti arba kazkas negerai";
            $negerai = "Langeliai tusti arba kazkas negerai";
            $classN= "danger";
}  



// mysqli_close($prisijungimas);

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