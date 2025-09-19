<?php

namespace App\Controllers;

/* use App\Models\Admin; */

use App\Models\Employe;
use App\Models\Avis;
use App\Models\Litige;

class EmployeController
{
  //function qui gere le dashboard admin
  public function dashboardEmploye()
  {
    requireLogin();

    $employeModel = new Employe();
    $avisModel = new Avis();
    $litigeModel = new Litige();

    //pagination
    $limit = 5; // 5 éléments par page
    $pageUtilisateur = isset($_GET['page_user']) ? (int)$_GET['page_user'] : 1;
    $offsetUser = ($pageUtilisateur - 1) * $limit;
    //model utilisateur
    $utilisateurs = $employeModel->getUsersPaginated($limit, $offsetUser);
    $totalUtilisateur = $employeModel->countUsers();
    //model avis et gestions des avis
    $avisEnAttente = $avisModel->getAvisEnAttente();
    //model des litiges
    $trajetLitige = $litigeModel->getAllLitiges();

    render(__DIR__ . '/../Views/pages/administration/dashboardEmploye.php', [
      'title' => 'Dashboard Employer',
      'utilisateurs' => $utilisateurs,
      'totalUtilisateur' => $totalUtilisateur,
      'pageUtilisateur' => $pageUtilisateur,
      'avisEnAttente' => $avisEnAttente,
      'trajetLitige' => $trajetLitige
    ]);
  }

  //function qui gere le changement de statut des user
  public function employeToggleUser()
  {
    requireLogin();

    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
      $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
      header("location: " . route('profil'));
      exit;
    }

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Employe();
      $model->toggleUser((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardEmploye'));
    exit;
  }
}
