<?php
//page de code qui gére le controller de la page d'accueil
//pour plus tard l'utiliser pour gére les affichage de la page home.
namespace App\Controllers;

use App\Models\Covoiturage;

require_once __DIR__ . '/../functions/view.php';

class HomeController
{
  public function index(): void
  {
    $model = new Covoiturage();
    $covoituragesPopulaires = $model->getCovoituragesPopulaires();
    render(__DIR__ . '/../views/pages/home.php', [
      'covoituragesPopulaires' => $covoituragesPopulaires,
      'title' => 'Accueil'
    ]);
  }

  public function showLogin()
  {
    render(__DIR__ . '/../views/pages/login.php', ['title' => 'Connexion']);
  }

  public function showMentions()
  {
    render(__DIR__ . '/../views/pages/mentionsCgu.php', ['title' => 'Mentions Légales & CGV']);
  }

  public function showContactForm()
  {
    render(__DIR__ . '/../views/pages/contactForm.php', ['title' => 'Formulaire de contacts']);
  }

  public function showCovoitPopulaire()
  {
    $model = new Covoiturage();
    $covoituragesPopulaires = $model->getCovoituragesPopulaires();

    $departAdresses = $model->getAdressesDepart();
    $arriveeAdresses = $model->getAdressesArrivee();
    $datesDepart = array_filter($model->getDatesDepart(), function ($date) { //filtre l'affichage par dates dans le selecte
      return strtotime($date) >= strtotime(date('Y-m-d'));
    });

    render(__DIR__ . '/../views/pages/home.php', [
      'covoituragesPopulaires' => $covoituragesPopulaires,
      'departAdresses' => $departAdresses,
      'arriveeAdresses' => $arriveeAdresses,
      'datesDepart' => $datesDepart
    ]);
  }
}
