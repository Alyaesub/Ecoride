<?php

namespace App\Controllers;

/* use App\Models\Admin; */

use App\Models\Employe;

class EmployeController
{
  //function qui gere le dashboard admin
  public function dashboardEmploye()
  {
    requireLogin();

    $employeModel = new Employe();

    //pagination
    $limit = 5; // 5 éléments par page
    $pageUtilisateur = isset($_GET['page_user']) ? (int)$_GET['page_user'] : 1;
    $offsetUser = ($pageUtilisateur - 1) * $limit;

    $utilisateurs = $employeModel->getUsersPaginated($limit, $offsetUser);
    $totalUtilisateur = $employeModel->countUsers();

    render(__DIR__ . '/../views/pages/administration/dashboardEmploye.php', [
      'title' => 'Dashboard Employer',
      'utilisateurs' => $utilisateurs,
      'totalUtilisateur' => $totalUtilisateur,
      'pageUtilisateur' => $pageUtilisateur
    ]);
  }

  //function qui gere le changement de statut des user
  public function toggleUser()
  {
    requireLogin();

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Admin();
      $model->toggleUser((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardEmploye'));
    exit;
  }
}
