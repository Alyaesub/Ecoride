<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/functions/view.php'; //pour appeler le moteur de rendu et la fonction render

use App\Controllers\HomeController;
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

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'covoitVoyage':
        render(__DIR__ . '/app/views/pages/formeCovoitVoyage.php', [
            'title' => 'Formulaire de covoiturage'
        ]);
        break;

    case 'login':
        render(__DIR__ . '/app/views/pages/login.php', [
            'title' => 'Connexion'
        ]);
        break;

    case 'profil':
        render(__DIR__ . '/app/views/pages/profilUsers.php', [
            'title' => 'Mon profil'
        ]);
        break;

    default:
        render(__DIR__ . '/app/views/pages/404.php', [
            'title' => 'Page introuvable'
        ]);
        break;
}
