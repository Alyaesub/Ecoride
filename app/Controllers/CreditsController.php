<?php
//feuille de code pour la gestion des credits

namespace App\Controllers;

use App\Models\GestionCredits;

class CreditsController
{

  public function showFormCredit()
  {
    render(__DIR__ . '/../Views/pages/creditsAchat.php', ['title' => 'Acheter vos crédits']);
  }

  /**
   * function qui ajoute des crédit apres "paiment
   */
  public function acheteCredits()
  {
    requireLogin();

    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
      $_SESSION['error'] = "Session expirée ou formulaire invalide, veuillez réessayer.";
      header("location: " . route('showFormCredit'));
      exit;
    }

    $idUser = $_SESSION['user']['id'];
    $creditAmount = intval($_POST['credit_amount'] ?? 0);

    if ($creditAmount <= 0) {
      $_SESSION['error'] = "Veuillez choisir une offre";
      header('Location: ' . route('showFormCredit'));
      exit();
    }

    $gestion = new GestionCredits();
    $ok = $gestion->ajouterCredits($idUser, $creditAmount);

    if ($ok) {
      // On met aussi à jour la session pour afficher les crédits en live
      if (!isset($_SESSION['user']['credits'])) {
        $_SESSION['user']['credits'] = 0;
      }
      $_SESSION['user']['credits'] += $creditAmount;
      $_SESSION['success'] = "✅ Crédits ajoutés avec succès !";
      header('Location: ' . route('showFormCredit'));
    } else {
      $_SESSION['error'] = "❌ Une erreur est survenue. Veuillez réessayer.";
      header('Location: ' . route('showFormCredit'));
    }
    exit();
  }
}
