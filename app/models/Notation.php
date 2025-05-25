<?php

namespace App\Models;

use App\Models\ConnexionDb;


class Notation
{
  public function ajouter($id_conducteur, $id_auteur, $id_covoiturage, $note)
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
INSERT INTO notation (id_utilisateur_cible, id_utilisateur_auteur, id_covoiturage, note)
VALUES (?, ?, ?, ?)
");
    return $stmt->execute([$id_conducteur, $id_auteur, $id_covoiturage, $note]);
  }

  public function existeDeja($id_auteur, $id_covoiturage)
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
SELECT COUNT(*) FROM notation
WHERE id_utilisateur_auteur = ? AND id_covoiturage = ?
");
    $stmt->execute([$id_auteur, $id_covoiturage]);
    return $stmt->fetchColumn() > 0;
  }
}
