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
        h1 {
            text-align: center;
        }

        /* .container {
            position:absolute;
            top:50%;
            left:50%;
            transform: translateY(-50%) translateX(-50%);
        } */

        .hide {
            display:none;
        }
    </style>

</head>
<body>
<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");    
}
?>
<?php
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM `klientai` WHERE `ID` = '$id'";
    // $result = $prisijungimas->query($sql); 
    $result = mysqli_query($prisijungimas, $sql);
    // var_dump($result);

    if($result->num_rows == 1) {
        $klientas = mysqli_fetch_array($result);
    
        $hideForm = false;
    } else {
        echo "ivyko kazkas blogai";
        // header("clients.php");
        //header("error.php");
        //header("createClient.php");
        //galime paslepti forma
        $hideForm = true;
    }

}
if(isset($_GET["submit"])) {
    if(isset($_GET["vardas"]) && isset($_GET["pavarde"])  && !empty($_GET["vardas"]) && !empty($_GET["pavarde"])) {
        $id = $_GET["ID"];
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        // $teises_id = intval($_GET["teises_id"]);

        $sql = "UPDATE `klientai` SET `vardas`='$vardas',`pavarde`='$pavarde' WHERE ID = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Vartotojas redaguotas sėkmingai (Po 5 sekundziu grsite i klientu valdyma)";
            $class = "success";
            $hideForm = true;
               
            
                         
            // header("Refresh:2; url=klientai.php");
            echo '<meta http-equiv="refresh" content="5;url=klientai.php">';

        } else {
            $negerai =  "Kazkas ivyko negerai";
            $classN = "danger";
        }
    // } else {
    //     $id = $klientas["ID"];
    //     $vardas = $klientas["vardas"];
    //     $pavarde = $klientas["pavarde"];
    //     // $teises_id = intval($client["teises_id"]);

    //     $sql = "UPDATE `klientai` SET `vardas`='$vardas',`pavarde`='$pavarde' WHERE ID = $id";
    //     if(mysqli_query($prisijungimas, $sql)) {
    //         $message =  "Vartotojas redaguotas sėkmingai";
    //         $class = "success";
    //     } else {
    //         $negerai =  "Kazkas ivyko negerai";
    //         $classN = "danger";
    //     }
    }
}
?>
<div class="container">
<?php require_once("priedai/menu.php"); ?>
    <?php if($hideForm == false) { ?>
            <h1>Vartotojo redagavimas</h1>
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
                
                <button class="btn btn-primary" type="submit" name="submit">Edit</button>
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
    
</body>
</html>