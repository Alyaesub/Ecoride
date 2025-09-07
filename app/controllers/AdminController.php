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


    $statsCovoiturages = $adminModel->getCovoituragesParJour();
    $statsCredits = $adminModel->getCreditsParJour();
    /**
     * bloque de code qui créé et transforme les tableau associatiffe pour geré les stats de covoit
     * un tableau jours 
     * un tableau total pour les covoit par jours
     * et un qui affiche les stats completes pour pouvoir gére les jours a 0 covoit 
     * et avoir un meillieur affichage 
     */
    // Créer un tableau des 7 derniers jours (au format Y-m-d)
    $jours = [];
    for ($i = 6; $i >= 0; $i--) {
      $jours[] = date('Y-m-d', strtotime("-$i days"));
    }
    // Transformer le tableau d’origine en associatif [jour => total]
    $totaux = [];
    foreach ($statsCovoiturages as $stat) {
      $totaux[$stat['jour']] = (int)$stat['total'];
    }
    // Créer le tableau final, avec 0 pour les jours manquants
    $statsCompletes = [];
    foreach ($jours as $jour) {
      $statsCompletes[] = [
        'jour' => $jour,
        'total' => $totaux[$jour] ?? 0
      ];
    }

    render(__DIR__ . '/../views/pages/administration/dashboardAdmin.php', [
      'title' => 'Dashboard Administration',
      'employes' => $employes,
      'totalEmployes' => $totalEmployes,
      'pageEmployes' => $pageEmployes,
      'utilisateurs' => $utilisateurs,
      'totalUtilisateur' => $totalUtilisateur,
      'pageUtilisateur' => $pageUtilisateur,
      'statsCovoiturages' => /* $statsCompletes */ $statsCovoiturages,
      'statsCredits' => $statsCredits
    ]);
  }
  //function qui gere le changement de statut d'un compte employé
  public function toggleEmploye()
  {
    requireLogin();

    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
      $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
      header("location: " . route('profil'));
      exit;
    }

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Admin();
      $model->toggleActif((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardAdmin'));
    exit;
  }

  //function qui gere le changement de statut des user
  public function AdminToggleUser()
  {
    requireLogin();

    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
      $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
      header("location: " . route('profil'));
      exit;
    }

    if (!empty($_POST['id_utilisateur'])) {
      $model = new Admin();
      $model->toggleUser((int) $_POST['id_utilisateur']);
    }

    header('Location: ' . route('dashboardAdmin'));
    exit;
  }
}
