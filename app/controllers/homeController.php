<?php
//page de code qui gére le controller de la page d'accueil
//pour plus tard l'utiliser pour gére les affichage de la page home.
namespace App\Controllers;



require_once __DIR__ . '/../functions/view.php';

class HomeController
{
  public function index(): void
  {
    render(__DIR__ . '/../views/pages/home.php', [
      'title' => 'Accueil'
    ]);
  }

  public function showMentions()
  {
    render(__DIR__ . '/../views/pages/mentionsCgu .php', ['title' => 'Mentions Légales & CGV']);
  }
}
