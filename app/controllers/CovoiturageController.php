<?php

namespace App\Controllers;

use App\Models\Covoiturage;
use App\Models\Notation;

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

  /**
   * function controller qui gére la recherche via le formCovoit dans voyages
   */

  public function showForm()
  {
    $model = new Covoiturage();

    $departAdresses = $model->getAdressesDepart();
    $arriveeAdresses = $model->getAdressesArrivee();
    $datesDepart = $model->getDatesDepart();

    render(__DIR__ . '/../views/pages/formeCovoitVoyage.php', [
      'departAdresses' => $departAdresses,
      'arriveeAdresses' => $arriveeAdresses,
      'datesDepart' => $datesDepart,
      'covoiturages' => [] // vide au début
    ]);
  }

  public function searchCovoitForm()
  {
    $model = new Covoiturage();
    $filters = $_GET;
    $covoiturages = $model->rechercherCovoiturages($filters);

    $departAdresses = $model->getAdressesDepart();
    $arriveeAdresses = $model->getAdressesArrivee();
    $datesDepart = $model->getDatesDepart();

    render(__DIR__ . '/../views/pages/formeCovoitVoyage.php', [
      'covoiturages' => $covoiturages,
      'departAdresses' => $departAdresses,
      'arriveeAdresses' => $arriveeAdresses,
      'datesDepart' => $datesDepart
    ]);
  }

  /**
   * function qui controlle l'affichage de la page détailsCovoit
   */
  public function showCovoitDetails()
  {
    if (!isset($_GET['id'])) {
      header('Location: ' . route('home'));
      exit;
    }

    $id = intval($_GET['id']);
    $model = new Covoiturage();
    $notationModel = new Notation();

    // Récupère les infos du covoiturage
    $covoit = $model->findById($id);

    if (!$covoit) {
      $_SESSION['error'] = "Covoiturage introuvable.";
      header('Location: ' . route('home'));
      exit;
    }

    // Moyenne des notes du conducteur
    $moyenne = $notationModel->getMoyenneParUtilisateur($covoit['id_utilisateur']);
    $covoit['note_conducteur'] = $moyenne;

    // Optionnel : déterminer si l'utilisateur peut participer
    $covoit['peut_participer'] = true; // à ajuster selon ta logique métier

    // Optionnel : déterminer si le covoit est terminé (par rapport à la date)
    $covoit['est_termine'] = strtotime($covoit['date_depart']) < time();

    // Est-ce que l'utilisateur a déjà noté ce covoit ?
    $idUser = $_SESSION['user_id'] ?? null;
    $covoit['deja_note'] = $idUser ? $notationModel->existeDeja($idUser, $id) : false;

    // Liste des passagers
    $passagers = $model->getPassagersByCovoiturage($id);

    render(__DIR__ . '/../views/pages/detailsCovoit.php', [
      'covoiturage' => $covoit,
      'passagers' => $passagers
    ]);
  }
}
