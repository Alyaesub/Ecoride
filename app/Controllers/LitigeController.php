<?php

namespace App\Controllers;

use App\Models\Litige;
use App\Models\Covoiturage;

class LitigeController
{
  //fonction qui en litige un covoit
  public function signalerLitige()
  {
    requireLogin();

    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
      $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
      header("location: " . route('profil'));
      exit;
    }

    $id = isset($_POST['id_covoiturage']) ? (int) $_POST['id_covoiturage'] : null;
    $id = $_POST['id_covoiturage'] ?? null;
    if ($id) {
      $model = new Covoiturage();
      $model->marquerCommeLitige($id);
      $_SESSION['success'] = "Le trajet a été marqué comme litige.";
    }
    header("Location: " . route('detailsCovoit') . '?id=' . $id);
    exit;
  }

  // Affiche tous les trajets en litige pour l'employé
  public function indexLitige()
  {
    requireLogin();
    $model = new Litige();
    $litiges = $model->getAllLitiges();

    render(__DIR__ . '/../Views/pages/employe/litiges.php', [
      'title' => 'Trajets à problèmes',
      'litiges' => $litiges
    ]);
  }

  // Affiche les détails d’un trajet en litige
  public function detailsLitige()
  {
    requireLogin();
    $id = $_GET['id'] ?? null;

    if (!$id) {
      $_SESSION['error'] = "ID du covoiturage manquant.";
      header("Location: " . route('litiges'));
      exit;
    }

    $model = new Litige();
    $details = $model->getDetailsLitige($id);
    $avis = $model->getAvisPourLitige($id);

    render(__DIR__ . '/../Views/pages/administration/detailsLitige.php', [
      'title' => "Détail du litige #$id",
      'details' => $details,
      'avis' => $avis
    ]);
  }

  // Marquer un litige comme résolu (valide, annulé, etc.)
  public function resoudreLitige()
  {
    requireLogin();
    $id = $_POST['id_covoiturage'] ?? null;
    $statut = $_POST['nouveau_statut'] ?? null;

    if ($id && $statut) {
      $model = new Litige();
      $model->resoudreLitige($id, $statut);
      $_SESSION['success'] = "Le litige a été résolu.";
    }
    header("Location: " . route('detailsLitige') . '?id=' . $id);
    exit;
  }
}
