<?php

namespace App\Controllers;

use App\Models\Notation;

class NotationAvisController
{
  /**
   * function Controller qui ajoute une notes
   */
  public function ajouterNote()
  {

    $id_auteur = $_SESSION['user_id'];
    $id_conducteur = $_POST['conducteur_id'] ?? null;
    $id_covoiturage = $_POST['covoiturage_id'] ?? null;
    $note = $_POST['note'] ?? null;

    $notation = new Notation();

    // Sécurité supplémentaire pour éviter l’erreur SQL
    if ($notation->existeDeja($id_auteur, $id_covoiturage)) {
      $_SESSION['error'] = "Vous avez déjà noté ce covoiturage.";
      header('Location: /detailsCovoit?id=' . $id_covoiturage);
      exit();
    }

    if ($id_conducteur && $id_covoiturage && $note >= 1 && $note <= 5) {
      $notation = new Notation();
      $notation->ajouter($id_conducteur, $id_auteur, $id_covoiturage, $note);
    }

    $_SESSION['success'] = "Merci pour votre note !";

    header('Location: /detailsCovoit?id=' . $id_covoiturage);
    exit();
  }
}
