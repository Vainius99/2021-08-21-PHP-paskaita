<div class="container">
    <div class="row">
<?php
if(!isset($_COOKIE["login"])) { 
    header("Location: index.php");    
} else {
    echo "<form action='klientai.php' method ='get'>";
    echo "<button class='btn btn-primary' type='submit' name='logout'>Logout</button>";
    echo "</form>";
    if(isset($_GET["logout"])) {
        setcookie("login", "", time() - 3600, "/");
        header("Location: index.php");
    }
}
//   reiktu teisiu veikima cia sufomuluoti
?>
    </div>
</div>