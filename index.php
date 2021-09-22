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

if(isset($_POST["submit"])) {
    if(isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM `vartotojai` WHERE `username` = '$username' AND `password` = '$password'";

        $result = $prisijungimas->query($sql);
        // var_dump($result);
        if($result->num_rows == 1) {
            $user_info = mysqli_fetch_array($result);
            $cookie_array = array(
                $user_info["ID"],
                $user_info["username"],
                $user_info["password"],
                $user_info["teises_id"],
            );
            $cookie_array = implode("|", $cookie_array);
            setcookie("login", $cookie_array, time() + 3600, "/");

            $sql = "UPDATE `vartotojai` SET `paskutinis_prisijungimas`= CURRENT_TIMESTAMP WHERE `username`= '$username'"; 
            if(mysqli_query($prisijungimas, $sql)) {
                header("location: klientai.php");
            } else {
                $negerai = "Negerai ";
                $classN = "danger";
            }
        } else {
            $negerai = "Neteisingi prisijungimo duomenys";
            $classN = "danger";
        }
    } else {
        $negerai = "Laukeliai yra tusti arba neteisingi duomenys";
        $classN = "danger";
    }
}

?>

<?php if(!isset($_COOKIE["login"])) { ?>
<div class="container">
        <h1>Klientų valdymo sistema</h1>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" value="admin"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" value="admin" />
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Prisijungti</button>
            <br>
            <?php 
            $sql = "SELECT * FROM `registracija` WHERE 1";
            $registracija = mysqli_query($prisijungimas, $sql);    
            $reg_info = mysqli_fetch_array($registracija); 
            if($reg_info["pasirinkimas"] == 1 ) {  ?>
            <a href="registracija.php">Registracija</a>
            <?php } ?>
        </form>
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
        header("Location: klientai.php");
    } ?>

</div>  
    <!-- laikas taisyklingai patvarkyti | klientai.php | vartotojai.php -->
    <?php mysqli_close($prisijungimas); ?>
</body>
</html>