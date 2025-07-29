<?php

namespace App\Controllers;

use App\Models\Admin;

class AdminController
{
  //function qui gere le dashboard admin
  public function dashboardAdmin()
  {
    requireLogin();

    $adminModel = new Admin();
    /* $employes = $adminModel->getAllEmployes();
    $utilisateurs = $adminModel->getAllUtilisateurs(); */

    //pagination
    $limit = 5; // 5 éléments par page
    $pageEmployes = isset($_GET['page_emp']) ? (int)$_GET['page_emp'] : 1;
    $pageUtilisateur = isset($_GET['page_user']) ? (int)$_GET['page_user'] : 1;
    $offsetEmp = ($pageEmployes - 1) * $limit;
    $offsetUser = ($pageUtilisateur - 1) * $limit;

    $employes = $adminModel->getEmployesPaginated($limit, $offsetEmp);
    $totalEmployes = $adminModel->countEmployes();

    $utilisateurs = $adminModel->getUsersPaginated($limit, $offsetUser);
    $totalUtilisateur = $adminModel->countUsers();

    render(__DIR__ . '/../views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration',
      'employes' => $employes,
      'totalEmployes' => $totalEmployes,
      'pageEmployes' => $pageEmployes,
      'utilisateurs' => $utilisateurs,
      'totalUtilisateur' => $totalUtilisateur,
      'pageUtilisateur' => $pageUtilisateur
    ]);
  }
  //function qui gere le changement de statut d'un compte employé
  public function toggleEmploye()
  {
    requireLogin();

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Admin();
      $model->toggleActif((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardAdmin'));
    exit;
  }

  //function qui gere le changement de statut des user
  public function toggleUser()
  {
    requireLogin();

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Admin();
      $model->toggleUser((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardAdmin'));
    exit;
  }
}
