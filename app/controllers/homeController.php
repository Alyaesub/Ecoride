<?php
//page de code qui gére le controller de la page d'accueil
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
}
