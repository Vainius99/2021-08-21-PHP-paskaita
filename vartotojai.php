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
        .hide {
            display:none;
        }
        .container {
            margin-bottom: 20px;
        }
        form {
        margin-top: 24px;
    }
        .red {
            color: red;
        }
        </style>
</head>
<body>
<?php require_once("prsijunges.php"); ?>
<?php if ($varT[3] != 2) { ?>
<?php
if($varT[3] == 4 || $varT[3] == 1) {
    if(isset($_GET["trinti"])){
        $id= $_GET["trinti"];
        
        $sql = ("DELETE FROM `vartotojai` WHERE `ID` = $id;");
            if (mysqli_query($prisijungimas, $sql)){
        $message = "Vartotojas sekmingai istrintas";
        $class = "success";
            } else 
                $negerai = "Kazkas negerai";
                $classN = "danger";
        }
}
?>  
    <div class="container">
        <?php require_once("priedai/menu.php"); ?>
        
        </nav>
        <div class="row">
            <div class="col-lg-4 col-md-3">
                <form class="form-inline" action="vartotojai.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Vartotoju paieska" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
                        <?php if(isset($_GET["search"]) && !empty($_GET["search"])) { ?>
                        <a class="btn btn-primary" href="vartotojai.php"> Išvalyti paiešką</a>
                        <?php } ?>
                </form>
            </div>
            <div class="col-lg-4 col-md-3">
            <form action="vartotojai.php" method="get">

            <select class="form-control" name="rikiavimas_id">
            <?php if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"]) && $_GET["rikiavimas_id"] != "default") {?>
                    <option value="DESC" selected="true"> Nuo didžiausio iki mažiausio</option>
                    <option value="ASC"> Nuo mažiausio iki didžiausio</option>
                    <?php } else { ?>
                    <option value="DESC"> Nuo didžiausio iki mažiausio</option>
                    <option value="ASC" selected="true"> Nuo mažiausio iki didžiausio</option>
                    <?php } ?>
            </select>
            <select class="form-control" name="filtravimas">
                <?php if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {?>
                    <option value="default">Rodyti visus</option>
                <?php } else { ?>
                    <option value="default" selected="true">Rodyti visus</option>
                <?php } ?>
                    <?php 
                         $sql = "SELECT * FROM vartotojai_teises";
                         $result = $prisijungimas->query($sql);
                        
                         while($userRights = mysqli_fetch_array($result)) {
                            if(isset($_GET["filtravimas"]) && $_GET["filtravimas"] == $userRights["reiksme"] ) {  
                                echo "<option value='".$userRights["reiksme"]."' selected='true'>";
                            } else { 
                                echo "<option value='".$userRights["reiksme"]."'>";
                            }
                                echo $userRights["pavadinimas"];
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-primary" type="submit" name="filtruoti">Filtras</button>
                </form>
            </div>    
        <div class="col-lg-4 col-md-3">
        
        <?php if ($varT[3] == 1) { ?>
            
            
            <?php 
            $sql = "SELECT * FROM `registracija` WHERE 1";
            $registracija = mysqli_query($prisijungimas, $sql);    
            $reg_info = mysqli_fetch_array($registracija); 
                if($reg_info["pasirinkimas"] == 1 ) { ?>
                    <form action="vartotojai.php" method="post">
                        <input class="hide" type="text" name="ijungta" value ="2" />
                        <button class="btn btn-primary" type="submit" name="on">Registracija Ijungta</button>
                    </form>
                    <?php  } else { ?>
                    <form action="vartotojai.php" method="post">
                        <input class="hide" type="text" name="isjungta" value ="1" />
                    <button class="btn btn-danger" type="submit" name="off">Registracija Isjungta</button>
                    </form>
                    <?php } ?>
            </div>    
            
            <?php
            if (isset($_POST["on"])) {
                    if(isset($_POST["ijungta"]) && !empty($_POST["ijungta"])) {
                        $onoff = intval($_POST["ijungta"]);
                        $sql = "UPDATE `registracija` SET `pasirinkimas`= $onoff WHERE `ID` = 1";
                        if(mysqli_query($prisijungimas, $sql)) {
                            echo '<meta http-equiv="refresh" content="0;url=vartotojai.php">';
                        } else {
                            $negerai =  "Kazkas ivyko negerai";
                            $classN = "danger";
                        }
                    } else { echo "kazlas negerai";
                }
            } 
            if (isset($_POST["off"])){
                    if(isset($_POST["isjungta"]) && !empty($_POST["isjungta"])) { 
                        $onofff = intval($_POST["isjungta"]);
                        $sql = "UPDATE `registracija` SET `pasirinkimas`= $onofff WHERE `ID` = 1";
                        if(mysqli_query($prisijungimas, $sql)) {
                            echo '<meta http-equiv="refresh" content="0;url=vartotojai.php">';
                        } else {
                            $negerai =  "Kazkas ivyko negerai";
                            $classN = "danger";
                        }
                    } else { echo "kazlas negerai";
                }
            }   
        ?> 
              
        <?php } ?> 
    
       
    </div>

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

        

    <div class="container">
        
        <div class="row"></div>
            <button id="user_create">Create New User</button>
        
            <div class="userForm d-none">
                <input  id="vardas" class="form-control" placeholder="Įveskite varda" />
                <input id="pavarde" class="form-control" placeholder="Įveskite pavarde" />
                <input id="username" class="form-control" placeholder="Įveskita slapyvardi" />
                <input id="teises_id" class="form-control" placeholder="Įveskita teises ID" />
                <button id="createUser">Create</button>
            </div>
        </div>

        <div id="alert-space"> </div>
        <!-- neisnyksta -->

        <div id="output">

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Vardas</th>
                    <th scope="col">Pavardė</th>
                    <th scope="col">Slapyvardis</th>
                    <th scope="col">Teises</th>
                    <th scope="col">Registracijos data</th>
                    <th scope="col">Paskutinis prisijungimas</th>
                    <th scope="col"><?php if($varT[3] == 4 || $varT[3] == 1 ) { echo "Veiksmai"; } ?></th>
                    </tr>
                </thead>
                
      

<?php

if(isset($_GET["filtravimas"]) && !empty($_GET["filtravimas"]) && $_GET["filtravimas"] != "default") {
    $filtravimas = "vartotojai.teises_id = ".$_GET["filtravimas"];
} else {
    $filtravimas = 1;
}

if(isset($_GET["rikiavimas_id"]) && !empty($_GET["rikiavimas_id"])) {
    $rikiavimas = $_GET["rikiavimas_id"];
} else {
    $rikiavimas = "DESC";
}

$sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE $filtravimas
ORDER BY vartotojai.ID $rikiavimas
";

if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT vartotojai.ID, vartotojai.vardas, vartotojai.pavarde, vartotojai.username, vartotojai_teises.pavadinimas, vartotojai.registracijos_data, vartotojai.paskutinis_prisijungimas 
FROM `vartotojai` 
LEFT JOIN `vartotojai_teises` ON vartotojai.teises_id = vartotojai_teises.reiksme
WHERE vartotojai.vardas LIKE '%".$search."%' OR vartotojai.pavarde LIKE '%".$search."%' OR vartotojai.username LIKE '%".$search."%' OR vartotojai_teises.pavadinimas LIKE '%".$search."%'
ORDER BY vartotojai.ID $rikiavimas
";
}
?>
            <tbody>
                    <?php

                $rezultatas = $prisijungimas->query($sql);

                    while($vartotojai = mysqli_fetch_array($rezultatas)) {
                        echo "<tr>";
                            echo "<td>". $vartotojai["ID"]."</td>";
                            echo "<td>". $vartotojai["vardas"]."</td>";
                            echo "<td>". $vartotojai["pavarde"]."</td>";
                            echo "<td>". $vartotojai["username"]."</td>";
                            echo "<td>". $vartotojai["pavadinimas"]."</td>";
                            echo "<td>". $vartotojai["registracijos_data"]."</td>";
                            echo "<td>". $vartotojai["paskutinis_prisijungimas"]."</td>";
                            echo "<td>";
                        if($varT[3] == 1 ) {
                            echo "<a href='vartotojaiEdit.php?ID=".$vartotojai["ID"]."'>Redaguoti</a>";
                        }
                            if($varT[3] == 4 || $varT[3] == 1 ) {
                            echo " ";
                            echo "<a class= 'red' href='vartotojai.php?trinti=".$vartotojai["ID"]."'>Trinti</a>";
                        }
                        echo "</td>";  
                        echo "</tr>";
                    }
                ?>
        </div>

            </tbody>
        </table>
    </div>
</div>
</div>
<?php } else { 
        echo "Error 404"; 
        echo "<br>";
        echo "<a href='klientai.php'>Back</a>";} ?> 


<script src="script.js"></script>  


  <!-- alert sutvarkyti -->
</body>
</html>