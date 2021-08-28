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
</head>
<body>
<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");    
}
?>

<form action="duomenuBazesSupilsymas.php" method="get">
    <button type="submit" name="sukurti">prideti 20 klientu</button>
</form>

<?php



if(isset($_GET["sukurti"])) {

    for($i=0; $i<20; $i++) {

        $imonesid = rand(1,10);
        $teisesid = rand(1, 5);

        $sql = "INSERT INTO `klientai`(`vardas`, `pavarde`, `teises_id`, `aprasymas`, `imones_id`, `pridejimo_data`) VALUES ('vardas$i', 'pavarde$i', $teisesid,'nera', $imonesid , CURRENT_TIMESTAMP)";

            if(mysqli_query($prisijungimas, $sql)) {

                echo "prideta";
        
            } else{
        
                echo "kazkas negerai";
        
            }
   
    }
  
} 

mysqli_close($prisijungimas);


?> 
    
</body>
</html>