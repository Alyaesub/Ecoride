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

    render(__DIR__ . '/../Views/pages/profilUsers.php', [
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
      if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
        header("location: " . route('profil'));
        exit;
      }
      $marqueModel = new Marque();

      $nom_marque = strtolower(trim($_POST['nom_marque'] ?? ''));
      $modele = $_POST['modele'] ?? '';
      $couleur = $_POST['couleur'] ?? '';
      $energie = $_POST['energie'] ?? '';
      $immatriculation = $_POST['immatriculation'] ?? '';

      // Blocage si champ vide
      if (empty($nom_marque)) {
        $_SESSION['error'] = "Le champ marque est obligatoire.";
        header('Location: ' . route('profil'));
        exit();
      }

      // Rechercher ou insérer la marque
      $marqueExistante = $marqueModel->findByName($nom_marque);

      if ($marqueExistante) {
        $id_marque = $marqueExistante['id_marque'];
      } else {
        $id_marque = $marqueModel->create($nom_marque);
      }

      // Si on  pas d’ID => erreur
      if (!$id_marque) {
        $_SESSION['error'] = "Impossible de créer ou retrouver la marque.";
        header('Location: ' . route('profil'));
        exit();
      }

      // Ajout du véhicule
      $vehiculeModel = new Vehicule();
      $vehiculeModel->create([
        'id_utilisateur' => $_SESSION['user_id'],
        'id_marque' => $id_marque,
        'modele' => $modele,
        'couleur' => $couleur,
        'energie' => $energie,
        'immatriculation' => $immatriculation
      ]);

      $_SESSION['success'] = "Véhicule ajouté avec succès.";
      header('Location: ' . route('profil'));
      exit();
    }
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
      if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
        header("location: " . route('profil'));
        exit;
      }
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
