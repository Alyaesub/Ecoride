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
        'fumeur' => isset($_POST['fumeur']) ? 1 : 0,
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
    $datesDepart = array_filter($model->getDatesDepart(), function ($date) { //filtre l'affichage par dates dans le selecte
      return strtotime($date) >= strtotime(date('Y-m-d'));
    });



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
    $id = intval($_GET['id']);
    $model = new Covoiturage();
    $notationModel = new Notation();

    // Récupère les infos du covoiturage
    $covoit = $model->findById($id);

    // Ajout du rôle utilisateur uniquement si connecté
    if (!empty($_SESSION['user_id'])) {
      $roleData = $model->getCovoitWithRoleById($id, $_SESSION['user_id']);
      if (!empty($roleData['role_utilisateur'])) {
        $covoit['role_utilisateur'] = $roleData['role_utilisateur'];
      }
    }

    if (!$covoit) {
      $_SESSION['error'] = "Covoiturage introuvable.";
      header('Location: ' . route('home'));
      exit;
    }

    $id_user = $_SESSION['user_id'] ?? null;
    $isAuthor = ($id_user && $covoit['id_utilisateur'] == $id_user);

    // Moyenne des notes du conducteur
    $moyenne = $notationModel->getMoyenneParUtilisateur($covoit['id_utilisateur']);
    $covoit['note_conducteur'] = $moyenne;

    // bouton pour l'utilisateur peut participer
    $id_user = $_SESSION['user_id'] ?? null;
    $covoit['peut_participer'] = ($id_user && $covoit['id_utilisateur'] != $id_user);

    // détermine si le covoit est terminé (par rapport à la date)
    $covoit['est_termine'] = strtotime($covoit['date_depart']) < time();

    // Est-ce que l'utilisateur a déjà noté ce covoit ?
    $idUser = $_SESSION['user_id'] ?? null;
    $covoit['deja_note'] = $idUser ? $notationModel->existeDeja($idUser, $id) : false;

    // Liste des passagers
    $passagers = $model->getPassagersByCovoiturage($id);

    render(__DIR__ . '/../views/pages/detailsCovoit.php', [
      'covoiturage' => $covoit,
      'passagers' => $passagers,
      'isAuthor' => $isAuthor
    ]);
  }

  /**
   * fonction qui permet de modifier un covoiturage
   */
  public function modifierCovoiturage()
  {
    requireLogin();

    $id = $_POST['id_covoiturage'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$id) {
      $_SESSION['error'] = "Aucun ID fourni.";
      header('Location: ' . route('home'));
      exit;
    }

    $model = new Covoiturage();
    $covoit = $model->findById($id);

    if (!$covoit || $covoit['id_utilisateur'] != $user_id) {
      $_SESSION['error'] = "Accès refusé.";
      header('Location: ' . route('home'));
      exit;
    }

    render(__DIR__ . '/../views/pages/modifierCovoit.php', [
      'title' => 'Modifier un covoiturage',
      'covoiturage' => $covoit
    ]);
  }

  /**
   * function qui valide la modif du covoit
   */
  public function validerModifCovoit()
  {
    requireLogin();

    $id = $_POST['id_covoiturage'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$id) {
      $_SESSION['error'] = "Covoiturage invalide.";
      header('Location: ' . route('home'));
      exit;
    }

    $model = new Covoiturage();
    $covoit = $model->findById($id);

    if (!$covoit || $covoit['id_utilisateur'] != $user_id) {
      $_SESSION['error'] = "Tu ne peux pas modifier ce covoit.";
      header('Location: ' . route('home'));
      exit;
    }

    // Données modifiables
    $data = [
      'adresse_depart' => $_POST['adresse_depart'],
      'adresse_arrivee' => $_POST['adresse_arrivee'],
      'date_depart' => $_POST['date_depart'],
      'date_arrivee' => $_POST['date_arrivee'],
      'prix_personne' => $_POST['prix_personne'],
      'places_disponibles' => $_POST['places_disponibles'],
      'est_ecologique' => $_POST['est_ecologique'] ?? null,
      'animaux_autoriser' => $_POST['animaux_autoriser'] ?? null,
      'fumeur' => $_POST['fumeur'] ?? null,
    ];

    $model->updateById($id, $data); //gére avec le model

    $_SESSION['success'] = "Le covoiturage a été modifié.";
    header('Location: ' . route('detailsCovoit') . '?id=' . $id);
    exit;
  }
  /**
   * function qui gére l'annulation du covoit
   */
  public function annulerCovoiturage()
  {
    requireLogin();

    $id = $_POST['id_covoiturage'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;

    if (!$id) {
      $_SESSION['error'] = "ID manquant.";
      header('Location: ' . route('home'));
      exit;
    }

    $model = new Covoiturage();
    $covoit = $model->findById($id);

    if ($covoit['id_utilisateur'] !== $_SESSION['user_id']) {
      $_SESSION['error'] = "Action non autorisée.";
      header('Location: ' . route('profil'));
      exit;
    }

    $model->updateStatut($id, 'annule');
    $_SESSION['success'] = "Covoiturage annulé avec succès.";

    header('Location: ' . route('detailsCovoit') . '?id=' . $id);
    exit;
  }

  /**
   * fonction qui gére si le covoit est terminer
   */
  public function terminerCovoiturage()
  {
    requireLogin();

    $id = $_POST['id_covoiturage'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;

    if (!$id) {
      $_SESSION['error'] = "ID manquant.";
      header('Location: ' . route('home'));
      exit;
    }

    $model = new Covoiturage();
    $covoit = $model->findById($id);

    if (!$covoit || $covoit['id_utilisateur'] != $userId) {
      $_SESSION['error'] = "Tu n’as pas l'autorisation de termoiner ce covoit.";
      header('Location: ' . route('home'));
      exit;
    }

    if (strtotime($covoit['date_depart']) < time()) {
      $model->updateStatut($id, 'termine');
    }

    $model->updateStatut($id, 'termine');
    $_SESSION['success'] = "Covoiturage terminé avec succès.";

    header('Location: ' . route('detailsCovoit') . '?id=' . $id);
    exit;
  }
  /**
   * function qui gére la participation au covoit
   */
  public function participeCovoiturage()
  {
    requireLogin();
    $id_utilisateur = $_SESSION['user_id'];
    $id_covoiturage = $_POST['id_covoiturage'] ?? null;

    if (!$id_covoiturage) {
      $_SESSION['error'] = "Covoiturage introuvable.";
      header('Location: /profil');
      exit;
    }

    $model = new Covoiturage();
    $covoit = $model->findById($id_covoiturage);

    if (!$covoit) {
      $_SESSION['error'] = "Ce covoiturage n'existe pas.";
      header('Location: /profil');
      exit;
    }

    // verifie si le user est le conducteur
    if ($covoit['id_utilisateur'] == $id_utilisateur) {
      $_SESSION['error'] = "Vous êtes le conducteur de ce covoiturage.";
      header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
      exit;
    }

    // verifie si terminer ou annuler
    if ($covoit['statut'] === 'termine' || $covoit['statut'] === 'annule') {
      $_SESSION['error'] = "Ce covoiturage n’est plus disponible.";
      header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
      exit;
    }

    // Vérifie s'il est déjà inscrit
    $existeDeja = $model->verifieParticipation($id_utilisateur, $id_covoiturage);
    if ($existeDeja) {
      $_SESSION['error'] = "Vous participez déjà à ce covoiturage.";
      header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
      exit;
    }
    $covoiturage['peut_participer'] = !$model->verifieParticipation($_SESSION['user_id'], $id_covoiturage);


    // Enregistre la participation
    $model->lierUtilisateur($id_utilisateur, $id_covoiturage, 'passager');
    $model->decrementePlacesDispo($id_covoiturage);


    $_SESSION['success'] = "Vous participez maintenant à ce covoiturage.";
    header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
    exit;
  }

  /**
   * fonction qui sert a annuler la participation d'un passager
   */
  public function annuleParticipation()
  {
    requireLogin();

    $id_utilisateur = $_SESSION['user_id'];
    $id_covoiturage = $_POST['id_covoiturage'] ?? null;

    if ($id_covoiturage) {
      $model = new Covoiturage();

      // Supprimer la participation
      $model->supprimerParticipation($id_utilisateur, $id_covoiturage);

      // Incrémenter les places
      $model->incrementePlacesDispo($id_covoiturage);

      $_SESSION['success'] = "Votre participation a été annulée.";
    }

    header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
    exit;
  }
}
