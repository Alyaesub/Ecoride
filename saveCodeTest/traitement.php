<?php
echo "<h1>Données reçues :</h1>";
echo "<pre>"; // Pour un affichage plus lisible
print_r($_POST); // Affiche toutes les données POST
print_r($_GET);
echo "</pre>";

// echo json_encode($_POST);
