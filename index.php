<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/functions/view.php'; //pour appeler le moteur de rendu et la fonction render
require_once __DIR__ . '/app/functions/helpers.php'; //pour appeler la fonction route
require_once __DIR__ . '/config/config.php'; //apelle la config pour gérer erreur et bug et connexionDB
require_once __DIR__ . '/app/functions/session.php'; // démarre la scession automatiquement

use App\Controllers\HomeController; //pour appeler le controller de la page d'accueil
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use App\Controllers\LogoutController;
use App\Controllers\UserController;
use App\Controllers\SearchCitiesController; //appelle le controller de la searchbar



// Init Whoops
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$page = $_GET['page'] ?? 'home';

switch ($page) {
  //routes vers le views
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
  case 'login-user':
    $controller = new UserController;
    echo "Déconnexion en cours...<br>";
    $controller->login();
    break;
  case 'logout':
    $controller = new LogoutController;
    $controller->logout();
    break;
  case 'register':
    render(__DIR__ . '/app/views/pages/register.php', [
      'title' => 'Créer votre profile'
    ]);
    break;

  case 'activites':
    render(__DIR__ . '/app/views/pages/activites.php', [
      'title' => 'Historique de vos activités'
    ]);
    break;
  case 'profil':
    $controller = new UserController;
    $controller->showProfile();
    break;
  case 'dashboardAdmin':
    render(__DIR__ . '/app/views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration'
    ]);
    break;
  case 'dashboardEmploye':
    render(__DIR__ . '/app/views/pages/administration/dashboardEmploye.php', [
      'title' => 'Dashboard Employer'
    ]);
    break;
  case 'search-cities':
    $controller = new SearchCitiesController();
    $controller->index();
    break;
  default:
    render(__DIR__ . '/app/views/pages/404.php', [
      'title' => 'Page introuvable'
    ]);
    break;
}
