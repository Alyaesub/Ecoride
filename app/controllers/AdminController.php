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


    render(__DIR__ . '/../views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration',
      'employes' => $employes
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
}
