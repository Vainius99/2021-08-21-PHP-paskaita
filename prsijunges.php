<div class="container">
    <div class="row">
<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");    
} else {
    echo "<form action='klientai.php' method ='get'>";
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