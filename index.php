<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
use App\Controllers\AdminController;
use App\Controllers\VehiculeController;
use App\Controllers\CovoiturageController;
use App\Controllers\CreditsController;
use App\Controllers\MaillingController;
use App\Controllers\NotationController;
use App\Controllers\AvisController;
use App\Controllers\DetailsProfilsController;
use App\Controllers\EmployeController;

// Init Whoops
$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

/**
 * Déclaration des routes
 */
$routes = [

  // Page d'accueil
  'home' => [HomeController::class, 'index'],
  'showCovoitPopulaire' => [HomeController::class, 'showCovoitPopulaire'],
  'login' => [HomeController::class, 'showLogin'],
  // Mentions légales et contacts
  'mentions' => [HomeController::class, 'showMentions'],
  'contactForm' => [HomeController::class, 'showContactForm'],
  //  searchbar recherche de villes 
  'searchCities' => [SearchCitiesController::class, 'searchCitiesBar'],
  // Formulaire de covoiturage
  'covoitVoyage' => [CovoiturageController::class, 'showForm'],
  'searchCovoitForm' => [CovoiturageController::class, 'searchCovoitForm'],
  'ajouterCovoiturage' => [CovoiturageController::class, 'create'],
  'supprimeCovoiturage' => [CovoiturageController::class, 'supprimeCovoit'],
  'detailsCovoit' => [CovoiturageController::class, 'showCovoitDetails'],
  'modifierCovoiturage' => [CovoiturageController::class, 'modifierCovoiturage'],
  'validerModifCovoit' => [CovoiturageController::class, 'validerModifCovoit'],
  'annulerCovoiturage' => [CovoiturageController::class, 'annulerCovoiturage'],
  'terminerCovoiturage' => [CovoiturageController::class, 'terminerCovoiturage'],
  'participeCovoiturage' => [CovoiturageController::class, 'participeCovoiturage'],
  'annuleParticipation' => [CovoiturageController::class, 'annuleParticipation'],
  'changerStatutCovoiturage' => [CovoiturageController::class, 'changerStatutCovoiturage'],
  // Notation et Avis 
  'ajouterNote' => [NotationController::class, 'ajouterNote'],
  'ajouterAvisMongo' => [AvisController::class, 'ajouterAvisMongo'],
  // Utilisateur : login, profil, enregistrement, mise à jour
  'login-user' => [UserController::class, 'login'],
  'profil' => [UserController::class, 'showProfile'],
  'registerUser' => [UserController::class, 'registerUser'],
  'updateUser' => [UserController::class, 'updateUser'],
  'logout' => [LogoutController::class, 'logout'],
  'updateRolePreference' => [UserController::class, 'updateRolePreference'],
  'detailsProfil' => [DetailsProfilsController::class, 'getDataChauffeur'],
  // Véhicules
  'vehicules' => [VehiculeController::class, 'showVehicule'],
  'ajouterVehicule' => [VehiculeController::class, 'create'],
  'deleteVehicule' => [VehiculeController::class, 'delete'],
  // Activités 
  'activites' => [ActiviteController::class, 'showActivites'],
  // Gestions des crédits
  'showFormCredit' => [CreditsController::class, 'showFormCredit'],
  'acheteCredits' => [CreditsController::class, 'acheteCredits'],
  // Mailling
  'ContactMailEcoride' => [MaillingController::class, 'sendContactMail'],
  // Dashboards admin
  'dashboardAdmin' => [AdminController::class, 'dashboardAdmin'],
  'registerEmploye' => [UserController::class, 'registerEmploye'],
  'toggleEmploye' => [AdminController::class, 'toggleEmploye'],
  'toggleUser' => [AdminController::class, 'toggleUser'],
  // Daschboard employe
  'dashboardEmploye' => function () {
    render(__DIR__ . '/app/views/pages/administration/dashboardEmploye.php', ['title' => 'Dashboard Employé']);
  },
  'dashboardemploye' => [EmployeController::class, 'dashboardEmploye'],
  'toggleUser' => [EmployeController::class, 'toggleUser'],
];

/**
 * Récupération de la route demandée par l'utilisateur
 */
// basenam récupère juste le dernier segment de l’URL (ex: "/profil" => "profil")
$page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
/**
 * Dispatcher qui appelle le bon contrôleur ou la bonne vue
 */
if (isset($routes[$page])) {
  $action = $routes[$page];
  // Si c’est une fonction anonyme
  if (is_callable($action)) {
    $action();
  } else {
    // Sinon, c’est un tableau [NomDuController, 'methode']
    [$class, $method] = $action;
    $controller = new $class();
    $controller->$method();
  }
} else {
  // si  route n'existe pas affiche une page 404
  render(__DIR__ . '/app/views/pages/404.php', ['title' => 'Page introuvable']);
}
