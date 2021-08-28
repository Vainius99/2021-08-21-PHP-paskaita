<?php require_once ("prijungimas.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once("priedai.php"); ?>
</head>
<body>
<?php
if(isset($_COOKIE["login"])) { 
    header("Location: index.php");    
} else {
    $hideForm = false;
}
?>

<?php 

if(isset($_POST["submit"])) {
    $vardas = $_POST["vardas"];
    $pavarde = $_POST["pavarde"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rePassword = $_POST["repeat_password"];

    $sql= "SELECT * FROM `vartotojai` WHERE `username` = '$username'";
    $result = $prisijungimas->query($sql);
        if($result->num_rows == 0 && $password == $rePassword) {
            $message = "Registracija buvo sekminga (Po 5 sekundziu griste i klientu valdyma)";
            $class = "success";
            $hideForm = true; 

            $sql = "INSERT INTO `vartotojai`(`vardas`, `pavarde`, `username`, `teises_id`, `password`, `registracijos_data`, `paskutinis_prisijungimas`) 
            VALUES ('$vardas','$pavarde','$username',3 ,'$password',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";

        echo '<meta http-equiv="refresh" content="5;url=klientai.php">';

        } else if ($password != $rePassword) {
            $negerai = "Neatitinka slaptazodis";
            $classN = "danger";
            $hideForm = false;

        } else { 
            $negerai = "Toks slapyvardis jau egzistuoja";
            $classN = "danger";
            $hideForm = false;

        }
}

?>

<div class="container">
<?php if($hideForm == false) { ?>
        <h1>Registracija</h1>
        <form action="registracija.php" method="post">
            <div class="form-group">
                <label for="vardas">Vardas</label>
                <input class="form-control" type="text" name="vardas" required="true"/>
            </div>
            <div class="form-group">
                <label for="pavarde">Pavarde</label>
                <input class="form-control" type="text" name="pavarde" required="true"/>
            </div>
            <div class="form-group">
                <label for="username">Slapyvardis</label>
                <input class="form-control" type="text" name="username" required="true"/>
            </div>
            <div class="form-group">
                <label for="password">Slaptazodis</label>
                <input class="form-control" type="password" name="password" required="true" />
            </div>
            <div class="form-group">
                <label for="repeat_password">Pakartoti Slaptazodi</label>
                <input class="form-control" type="password" name="repeat_password" required="true" />
            </div>

            <a href="index.php">Prisijungimas</a><br>
            <button class="btn btn-primary" type="submit" name="submit">Registracija</button>
        </form>
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
    
    <?php mysqli_close($prisijungimas); ?>
</body>
</html>