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
        <header>
            <?php
            require_once 'app/views/partials/header.php'; //require du header
            ?>
        </header>

        <body>
            <?php
            require_once 'app/views/partials/home.php'; // j'ai require le home
            ?>
        </body>

        <footer>
            <?php
            require_once 'app/views/partials/footer.php'; //require du footer
            ?>
        </footer>
    </main>
</body>

</html>