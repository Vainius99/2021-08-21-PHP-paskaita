<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div>
  <a class= "nav-link " href="klientai.php">Kientu valdymas</a>
  </div>
  <br>
  <?php if($varT[3] != 3 ) { ?>
  <div class="navbar-nav">
      <a class="nav-link" href="klientupildymoforma.php">Kientu pildymas <span class="sr-only">(current)</span></a>
  </div>
  <?php } ?>
  <a class= "nav-link " href="imones.php">Imoniu valdymas</a>
  <?php if($varT[3] != 3 ) { ?>
  <div class="navbar-nav">
      <a class="nav-link" href="imonespildymoforma.php">imoniu pildymas <span class="sr-only">(current)</span></a>
  </div>
  <?php } ?>
  <?php if ($varT[3] != 2) { ?>
  <a class= "nav-link " href="vartotojai.php">Vartotoju valdymas</a>
  <?php } ?>
  <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> -->
  <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-link" href="klientupildymoforma.php">Kientu pildymas <span class="sr-only">(current)</span></a>
    </div>
  </div> -->
  <!-- <form class="form-inline" action="klientai.php" method="get">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Klientu paieska" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_push">Search</button>
  </form>
</nav> -->

<!-- meniu padirbeti -->