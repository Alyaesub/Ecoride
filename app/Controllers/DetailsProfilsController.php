<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Notation;
use App\Models\Avis;

class DetailsProfilsController
{

  /**
   * function qui recupere le donné de l'user selectionner
   */
  public function getDataChauffeur()
  {
    $userId = $_GET['id'] ?? null;

    if (!$userId) {
      echo "<p>Utilisateur non trouvé.</p>";
      exit;
    }

    $userModel = new User();
    $notationModel = new Notation();
    $avisModel = new Avis();

    $utilisateur = $userModel->findById($userId);
    $moyenne = $notationModel->getMoyenneParUtilisateur($userId);
    $avis = $avisModel->getAvisReçus($userId);

    render(__DIR__ . '/../Views/pages/detailsProfil.php', [
      'title' => 'Détails du profil',
      'utilisateur' => $utilisateur,
      'moyenne' => $moyenne,
      'avis' => $avis,
    ]);
  }
}
