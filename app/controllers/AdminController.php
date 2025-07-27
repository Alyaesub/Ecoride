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
    $employes = $adminModel->getAllEmployes();
    $utilisateurs = $adminModel->getAllUtilisateurs();


    render(__DIR__ . '/../views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration',
      'employes' => $employes,
      'utilisateurs' => $utilisateurs
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
