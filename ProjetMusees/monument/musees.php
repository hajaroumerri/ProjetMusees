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
        
        <link rel="stylesheet" href="../css/index.css">
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
            integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
            crossorigin="">
        </script>

<!--Récupération de la map qui sera afficher afin d'y afficher la position des musées
    On utilise openstreetmap-->

    <script type="text/javascript">

        var lat = <?php echo $_GET['lat']; ?>;
        var lon = <?php echo $_GET['lon']; ?>;
        var museeNom = "<?php echo $_GET['musee']; ?>";
        var siteWeb = "<?php echo $_GET['site']; ?>";
        var macarte = null;

        function initMap() {

            macarte = L.map('map').setView([lat, lon], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {

                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(macarte);
            var marker = L.marker([lat, lon]).addTo(macarte);
            let newLink = document.createElement("A");
            newLink.href = siteWeb;
            newLink.text = museeNom;
            newLink.target = "_blank";

            marker.bindPopup(newLink);
        }
        window.onload = function() {
            initMap();
        };

    </script>


    </head>

<body>

<!-- Affichage du menu-->

</div>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Musées de Paris</a></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="musees.php">Musées</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../connexion/formulaire.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../connexion/deconnexion.php">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../inscription/formulaire.php">Inscription</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br><br><br>

<!------------------------------------------------------------------------------------>

    <div class='row'>
        <div class='col-md-6' id="map"></div>

        <?php
        require_once("../sparqllib.php");

        $db = sparql_connect("https://dbpedia.org/sparql");

        if (!$db) {
            print sparql_errno() . ": " . sparql_error() . "\n";
            exit;
        }

        sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
        sparql_ns("dbp", "http://dbpedia.org/property/");
        sparql_ns("dbo", "http://dbpedia.org/ontology/");
        sparql_ns("xsd", "http://www.w3.org/2001/XMLSchema#");

      // requete sparql

        $sparql = "SELECT DISTINCT ?Nom, ?Latitude, ?Longitude, ?SiteWeb WHERE {

            ?s dct:subject dbc:Museums_in_Paris.
            ?s dbp:name ?Nom.
            ?s geo:lat ?Latitude.
            ?s geo:long ?Longitude.
            ?s foaf:homepage ?SiteWeb
        }";


        $result = sparql_query($sparql);
        if (!$result) {
            print sparql_errno() . ": " . sparql_error() . "\n";
            exit;
        }
        
        $fields = sparql_field_array($result);

        //var_dump($result);

        print "<div class= 'col-md-6'>";
        if (isset($_SESSION['prenom'])){
            print "<p>Salut ". $_SESSION['prenom']." voici la liste des musées de Paris</p>";
        }else{
            print "<p>Voici la liste des musées sur Paris :<br></br>";
            
        }

        // affichage du tableau avec le nom du musée ainsi que sa postion sur la carte
        print "<table>";
        print "<tr>";
        foreach ($fields as $field) {
            if ($field == "Nom" || $field == "Carte") {
                print "<th>$field</th>";
            }
        }
        print "<th>Map</th>";
        print "</tr>";
        $name="";
        $map="";

        while ($row = sparql_fetch_array($result)) {
            print "<tr>";
            $tab = [];
            foreach ($fields as $field) {
                $test = str_replace("'", " ", $row[$field]);
                array_push($tab, $test);

                if ($field == "Nom" || $field == "Map") {

                    if (($field == "Nom" && $name == $row[$field] )||($field == "Map" && $map == $row[$field]))  {

                        print "<td>$row[$field]</td>";

                        if ($field == "Nom" ){
                            $name = $row[$field];
                        } else if( $field == "Map") {
                            $map = $row[$field];
                        }
                    }
                }

                $name =$row[$field];
                $map=$row[$field];
            }
            print "<td><a href='./musees.php?musee=$tab[0]&lat=$tab[1]&lon=$tab[2]&site=$tab[3]&test=true'>Afficher sur la map</a></td>";
            print "</tr>";
        }
        print "</table>";
        print "</div>";
        ?>
</body>

</html>