<?php

namespace App\Models;

use PDO;
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
  //methode qui regarde si le covoit et déja noter
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

  /**
   * methode qui gére les notes reçus
   */
  public function getNotesRecues($id_utilisateur)
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
    SELECT n.note, n.date_notation, u.pseudo AS auteur
    FROM notation n
    JOIN utilisateur u ON n.id_utilisateur_auteur = u.id_utilisateur
    WHERE n.id_utilisateur_cible = ?
    ORDER BY n.date_notation DESC
  ");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * methode qui regarde la moyenne des notes par user
   */
  public function getMoyenneParUtilisateur($id_utilisateur)
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
    SELECT ROUND(AVG(note), 1) AS moyenne
    FROM notation
    WHERE id_utilisateur_cible = ?
  ");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchColumn();
  }
}
