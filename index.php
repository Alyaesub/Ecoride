<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/functions/view.php'; //pour appeler le moteur de rendu et la fonction render
require_once __DIR__ . '/app/functions/helpers.php'; //pour appeler la fonction route
require_once __DIR__ . '/config/config.php'; //apelle la config pour gérer erreur et bug et connexionDB
require_once __DIR__ . '/app/functions/session.php'; // démarre la scession automatiquement


use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

use App\Controllers\HomeController; //pour appeler le controller de la page d'accueil
use App\Controllers\LogoutController; //appelle le logout
use App\Controllers\UserController; //applle le user controller
use App\Controllers\SearchCitiesController; //appelle le controller de la searchbar
use App\Controllers\ActiviteController;
use App\Controllers\VehiculeController;
use App\Controllers\CovoiturageController;


// Init Whoops
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

/* $page = $_GET['page'] ?? 'home'; */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path === false) {
  exit;
}

$page = ltrim($path, '/');


switch ($page) {
  //routes vers le views et controlleurs
  case 'home':
    $controller = new HomeController();
    $controller->index();
    break;
  case 'mentions':
    $controller = new HomeController();
    $controller->showMentions();
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
  case 'search-cities':
    $controller = new SearchCitiesController();
    $controller->searchCitiesBar();
    break;
  case 'login-user':
    $controller = new UserController;
    $controller->login();
    break;
  case 'profil':
    $controller = new UserController;
    $controller->showProfile();
    break;
  case 'logout':
    $controller = new LogoutController;
    $controller->logout();
    break;
  case 'registerUser':
    $controller = new UserController;
    $controller->registerUser();
    break;
  case 'updateUser':
    $controller = new UserController;
    $controller->updateUser();
    break;
  case 'vehicules':
    $controller = new VehiculeController;
    $controller->showVehicule();
    break;
  case 'ajouterVehicule':
    $controller = new VehiculeController;
    $controller->create();
    break;
  case 'deleteVehicule':
    $controller = new VehiculeController;
    $controller->delete();
    break;
  case 'activites':
    $controller = new ActiviteController;
    $controller->showActivites();
    break;
  case 'ajouterCovoiturage':
    $controller = new CovoiturageController;
    $controller->create();
    break;
  case 'supprimeCovoiturage':
    $controller = new CovoiturageController;
    $controller->supprimeCovoit();
    break;
  case 'activites-notes':
    $controller = new ActiviteController;
    $controller->ajouterNote();
    break;
  case 'dashboardAdmin':
    render(__DIR__ . '/app/views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration'
    ]);
    break;
  case 'registerEmploye':
    $controller = new UserController;
    $controller->registerEmploye();
    break;
  case 'dashboardEmploye':
    render(__DIR__ . '/app/views/pages/administration/dashboardEmploye.php', [
      'title' => 'Dashboard Employer'
    ]);
    break;
  default:
    render(__DIR__ . '/app/views/pages/404.php', [
      'title' => 'Page introuvable'
    ]);
    break;
}
