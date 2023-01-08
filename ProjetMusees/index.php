<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['prenom'])) {
    session_unset();
}
?>
<html>

<head>
 <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Musées de Paris</title>
   
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" /> 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/slidercss.css">
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin="">
    </script>
   
</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Musées de Paris</a></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="monument/musees.php">Musées</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion/formulaire.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion/connexion.php">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inscription/formulaire.php">Inscription</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>

   <div class="container">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/toureiffel.jpeg" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/triomphe.jpeg"  style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/lou.jpeg" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/mon.jpeg" style="width:100%;">
      </div>
    </div>


    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>



</body>
</html>
