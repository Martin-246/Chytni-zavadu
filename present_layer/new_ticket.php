<?php 
session_start();
include_once('../bussiness_layer/print_categories.php');


?>
<html>
    <head>
        <title>Novy tiket</title>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./new_ticket.css" />
        <script type="module" src="./new_ticket.js"></script>
        <style>
            
        </style>
    </head>
    <body>
        <div id="page">
        <nav>
            <h2 class="grow1"><a href = "../index.php">Späť</a></h2>
            <h2 class="grow10">Nový tiket</h2>
        </nav>
        <h3>Vyber pozíciu na mape<h3>
        <div id="map"></div><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJVGL83AulBYsKWzBA0ooSruG4_CVIWqA&callback=initMap"defer></script>
        
        <form id="form" method="post" action="../bussiness_layer/create_ticket.php" enctype="multipart/form-data">
        <br><label for="category">Pozicia</label><br>
        <input type="text" id="lng" name="lng">
        <input type="text" id="lat" name="lat"><br>
        <br><label for="category">Kategoria</label><br>
        <select name="category">  <?php print_categories(); ?> </select><br>
        <br><label for="fileToUpload">Nahraj fotku (volitelne)</label><br>
        <input type="file" id="fileToUpload" name="fileToUpload"><br>
        
        
        <br><input type = "submit" value="Odoslat"><br>
        </div>
    </body>
</html>