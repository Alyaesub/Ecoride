<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Vehicule;
use App\Models\Marque;

class VehiculeController
{
  /**
   * Affiche la page des véhicules de l'utilisateur connecté.
   */
  public function showVehicule()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }

    $userModel = new User();
    $vehiculeModel = new Vehicule();
    $marqueModel = new Marque();

    $user = $userModel->findById($_SESSION['user_id']);
    $vehicules = $vehiculeModel->findAllByUserId($_SESSION['user_id']);
    $marques = $marqueModel->findAll();

    render(__DIR__ . '/../views/pages/profilUsers', [
      'user' => $user,
      'vehicules' => $vehicules,
      'marques' => $marques
    ]);
  }

  /**
   * Enregistre un nouveau véhicule.
   */
  public function create()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'id_utilisateur' => $_SESSION['user_id'],
        'id_marque' => $_POST['id_marque'] ?? null,
        'modele' => $_POST['modele'] ?? '',
        'couleur' => $_POST['couleur'] ?? '',
        'energie' => $_POST['energie'] ?? '',
        'immatriculation' => $_POST['immatriculation'] ?? '',
      ];

      $vehiculeModel = new Vehicule();
      $vehiculeModel->create($data);

      $_SESSION['success'] = "Véhicule ajouté avec succès.";
    }

    header('Location: ' . route('profil'));
    exit();
  }

  /**
   * Supprime un véhicule.
   */
  public function delete()
  {

    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_vehicule'])) {
      $idVehicule = (int) $_POST['id_vehicule'];

      $vehiculeModel = new Vehicule();
      $vehiculeModel->delete($idVehicule, $_SESSION['user_id']);

      $_SESSION['success'] = "Véhicule supprimé avec succès.";
    }

    header('Location: ' . route('profil'));
    exit();
  }

  public function update() {}
}
