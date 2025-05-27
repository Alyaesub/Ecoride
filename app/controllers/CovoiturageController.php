<?php

namespace App\Controllers;

use App\Models\Covoiturage;

class CovoiturageController
{
  /**
   * fonction qui crée un covoiturage 
   */
  public function create()
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $model = new Covoiturage();


      $id_utilisateur = $_SESSION['user']['id'];
      $id_vehicule = $model->getVehiculeByUser($id_utilisateur);

      $data = [
        'id_utilisateur' => $id_utilisateur,
        'id_vehicule' => $id_vehicule,
        'adresse_depart' => trim($_POST['adresse_depart']),
        'adresse_arrivee' => trim($_POST['adresse_arrivee']),
        'date_depart' => $_POST['date_depart'],
        'date_arrivee' => $_POST['date_arrivee'],
        'prix_personne' => floatval($_POST['prix_personne']),
        'places_disponibles' => intval($_POST['places_disponibles']),
        'est_ecologique' => isset($_POST['est_ecologique']) ? 1 : 0,
        'animaux_autorises' => isset($_POST['animaux_autoriser']) ? 1 : 0,
        'fumeur' => isset($_POST['fumeur']) ? 1 : 0
      ];


      if (!$id_vehicule) {
        $_SESSION['error'] = "Aucun véhicule trouvé pour votre compte.";
        header('Location: ' . route('profil'));
        exit;
      }

      try {
        $id_covoiturage = $model->create($data);
        $model->lierUtilisateur($data['id_utilisateur'], $id_covoiturage, $_POST['role_utilisateur']);
        $_SESSION['success'] = "Covoiturage enregistré avec succès !";
      } catch (\Exception $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        $_SESSION['error'] = "Une erreur est survenue lors de l'enregistrement du covoiturage.";
      }

      header('Location: ' . route('profil'));
      exit;
    }
  }

  /**
   * function qui supprime un covoit 
   */
  public function supprimeCovoit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_covoiturage'])) {
      $id = intval($_POST['id_covoiturage']);
      $model = new Covoiturage();

      try {
        $model->supprimeCovoit($id);
        $_SESSION['success'] = "Covoiturage supprimé avec succès.";
      } catch (\Exception $e) {
        $_SESSION['error'] = "Erreur lors de la suppression : " . $e->getMessage();
      }
    }

    header('Location: ' . route('profil'));
    exit;
  }
}
