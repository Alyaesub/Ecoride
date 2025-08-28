<?php

namespace App\Controllers;

/* use App\Models\Admin; */

use App\Models\Employe;
use App\Models\Avis;

class EmployeController
{
  //function qui gere le dashboard admin
  public function dashboardEmploye()
  {
    requireLogin();

    $employeModel = new Employe();
    $avisModel = new Avis();

    //pagination
    $limit = 5; // 5 éléments par page
    $pageUtilisateur = isset($_GET['page_user']) ? (int)$_GET['page_user'] : 1;
    $offsetUser = ($pageUtilisateur - 1) * $limit;
    //model utilisateur
    $utilisateurs = $employeModel->getUsersPaginated($limit, $offsetUser);
    $totalUtilisateur = $employeModel->countUsers();
    //model avis et gestions des avis
    $avisEnAttente = $avisModel->getAvisEnAttente();

    render(__DIR__ . '/../views/pages/administration/dashboardEmploye.php', [
      'title' => 'Dashboard Employer',
      'utilisateurs' => $utilisateurs,
      'totalUtilisateur' => $totalUtilisateur,
      'pageUtilisateur' => $pageUtilisateur,
      'avisEnAttente' => $avisEnAttente
    ]);
  }

  //function qui gere le changement de statut des user
  public function toggleUser()
  {
    requireLogin();

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Employe();
      $model->toggleUser((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardEmploye'));
    exit;
  }
}
