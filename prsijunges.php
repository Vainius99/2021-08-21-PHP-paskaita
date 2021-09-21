<div class="container">
    <div class="row">
<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: login.php");    
} else {
    echo "<form action='index.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
    echo "</form>";
    $varT = explode("|", $_COOKIE["login"]);
        if(isset($_GET["logout"])) {
            setcookie("login", "", time() - 3600, "/");
            header("Location: index.php");
        }
}

?>
    </div>
</div>