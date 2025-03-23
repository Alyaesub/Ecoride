<?php
session_start();       // Démarrer la session
session_unset();       // Détruire toutes les variables de session
session_destroy();     // Détruire la session elle-même
header('Location: ../index.php');  // Rediriger vers la page de connexion (ou une autre page de votre choix)
exit();
