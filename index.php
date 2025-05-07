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



// Init Whoops
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$page = $_GET['page'] ?? 'home';

switch ($page) {
  //routes vers le views et controlleurs
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
    $controller->login();
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
  case 'registerEmploye':
    $controller = new UserController;
    $controller->registerEmploye();
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
