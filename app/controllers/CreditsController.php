<?php
//feuille de code pour la gestion des credits

namespace App\Controllers;

use App\Models\Covoiturage;

class CreditsController
{

  public function showFormCredit()
  {
    render(__DIR__ . '/../views/pages/creditsAchat.php', ['title' => 'Acheter vos crédits']);
  }
}
