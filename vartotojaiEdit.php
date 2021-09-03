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
<?php if($varT[3] = 1) { ?>
<?php
if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM `vartotojai` WHERE `ID` = $id";
    // $result = $prisijungimas->query($sql); 
    $result = mysqli_query($prisijungimas, $sql);
    // var_dump($result);

    if($result->num_rows == 1) {
        $user = mysqli_fetch_array($result);
    
        $hideForm = false;
    } else {
        echo "ivyko kazkas blogai";
        $hideForm = true;
    }

}
if(isset($_GET["submit"])) {
    if(isset($_GET["vardas"]) && isset($_GET["pavarde"]) && isset($_GET["username"]) && isset($_GET["teises_id"]) && !empty($_GET["vardas"]) && !empty($_GET["pavarde"]) && !empty($_GET["username"]) && !empty($_GET["teises_id"])) {
        $id = $_GET["ID"];
        $vardas = $_GET["vardas"];
        $pavarde = $_GET["pavarde"];
        $teises_id = intval($_GET["teises_id"]);
        $username = $_GET["username"];

        $sql = "UPDATE `vartotojai` SET `vardas`='$vardas',`pavarde`='$pavarde',`username`= '$username', `teises_id`= $teises_id WHERE ID = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Vartotojas redaguotas sėkmingai (Po 5 sekundziu griste i Vartotoju valdyma)";
            $class = "success";
            $hideForm = true;           
            // header("Refresh:5; url=klientai.php");
            echo '<meta http-equiv="refresh" content="5;url=vartotojai.php">';

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
            <h1>Vartotojo redagavimas</h1>
            <form action="vartotojaiEdit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $user["ID"] ?>" />

                <div class="form-group">
                    <label for="vardas">Vardas</label>
                    <input class="form-control" type="text" name="vardas" value="<?php echo $user["vardas"] ?>" />
                </div>
                <div class="form-group">
                    <label for="pavarde">Pavardė</label>
                    <input class="form-control" type="text" name="pavarde" value="<?php echo $user["pavarde"] ?>"/>
                </div>
                <div class="form-group">
                    <label for="username">Slapyvardis</label>
                    <input class="form-control" type="text" name="username" value="<?php echo $user["username"] ?>"/>
                </div>
                <div class="form-group">
                    <label for="teises_id">Teisės</label>
                    <select class="form-control" name="teises_id">
                    <?php 
                         $sql = "SELECT * FROM vartotojai_teises";
                         $result = $prisijungimas->query($sql);
                        
                         while($vartotojuTeises = mysqli_fetch_array($result)) {

                            if($user["teises_id"] == $vartotojuTeises["reiksme"] ) {
                                echo "<option value='".$vartotojuTeises["reiksme"]."' selected='true'>";
                            }  else {
                                echo "<option value='".$vartotojuTeises["reiksme"]."'>";
                            }  
                                
                                echo $vartotojuTeises["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Issaugoti</button>
                <br>
                <a href="vartotojai.php">Back</a> 
               
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
        echo "<a href='vartotojai.php'>Back</a>";} ?> 
   
    <?php mysqli_close($prisijungimas); ?> 
</body>
</html>