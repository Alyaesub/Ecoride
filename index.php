<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\TestController;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;


// Init Whoops
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

// Test autoload
/* $test = new TestController();
$test->hello(); */

// Test erreur Whoops (tu peux commenter après)
/* throw new Exception("Oups, une belle erreur stylée !"); */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil EcoRide</title>
    <link rel="stylesheet" href="/public/styles/css/main.css">
</head>

<body>
    <main>
        <?php
        $page = $_GET['page'] ?? 'home';

        switch ($page) {
            case 'home':
                require 'app/views/pages/home.php';
                break;

            case 'covoitVoyage':
                require 'app/views/pages/formeCovoitVoyage.php';
                break;

            case 'login':
                require 'app/views/pages/login.php';
                break;

            case 'profil':
                require 'app/views/pages/profilUsers.php';
                break;

            default:
                require 'app/views/pages/404.php'; // une page 404 si tu veux
                break;
        }
        ?>
    </main>
    <footer class="footer">
        <?php require 'app/views/partials/footer.php'; ?>
    </footer>
</body>

</html>