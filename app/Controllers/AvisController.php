<?php

namespace App\Controllers;

use App\Models\Avis;

class AvisController
{
  public function ajouterAvisMongo()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
        header("location: " . route('profil'));
        exit;
      }
      $commentaire = trim($_POST['commentaire'] ?? '');
      $id_utilisateur = intval($_POST['id_utilisateur'] ?? 0);
      $id_covoiturage = intval($_POST['id_covoiturage'] ?? 0);
      $id_auteur = intval($_POST['id_auteur'] ?? 0);

      if ($commentaire && $id_utilisateur && $id_covoiturage) {
        $avis = new Avis();
        $avisId = $avis->ajouterCommentaire([
          'commentaire' => $commentaire,
          'id_utilisateur' => $id_utilisateur,
          'id_covoiturage' => $id_covoiturage,
          'id_auteur' => $id_auteur
        ]);

        $_SESSION['success'] = "Commentaire ajouté avec succès (#$avisId).";
      } else {
        $_SESSION['error'] = "Erreur : tous les champs sont requis.";
      }
      header('Location: ' . route('detailsCovoit') . '?id=' . $id_covoiturage);
      exit;
    }
    // fallback
    $_SESSION['error'] = "Méthode non autorisée.";
    header('Location: ' . route('home'));
    exit;
  }
  public function validerAvis()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_avis'])) {
      if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
        header("location: " . route('profil'));
        exit;
      }
      $id = $_POST['id_avis'];
      $avis = new Avis();
      $avis->changerStatut($id, 'validé');
    }
    header('Location: ' . route('dashboardEmploye'));
    exit;
  }

  public function refuserAvis()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_avis'])) {
      if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
        header("location: " . route('profil'));
        exit;
      }
      $id = $_POST['id_avis'];
      $avis = new Avis();
      $avis->changerStatut($id, 'refusé');
    }
    header('Location: ' . route('dashboardEmploye'));
    exit;
  }
}
