<?php

namespace App\Models;

use App\Models\ConnexionDb;
use PDO;


class ParametreModel
{
  private PDO $pdo;
  public function __construct()
  {
    // Connexion à la base de données via le modèle ConnexionDb
    $this->pdo = ConnexionDb::getPdo();
  }

  /**
   * function qui recupere les parametres de l'utilisateur
   */
  public function getParametresByUserId($id_utilisateur)
  {
    $stmt = $this->pdo->prepare("SELECT propriete, valeur FROM parametre WHERE id_utilisateur = ?");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * function qui met a jours les parametres de l'utilisateur
   */
  public function updateParametre($id_utilisateur, $propriete, $valeur)
  {
    // Vérifie si le paramètre existe déjà
    $stmt = $this->pdo->prepare("SELECT id_parametre FROM parametre WHERE id_utilisateur = ? AND propriete = ?");
    $stmt->execute([$id_utilisateur, $propriete]);
    $existing = $stmt->fetch();

    if ($existing) {
      $stmt = $this->pdo->prepare("UPDATE parametre SET valeur = ? WHERE id_utilisateur = ? AND propriete = ?");
      $stmt->execute([$valeur, $id_utilisateur, $propriete]);
    } else {
      $stmt = $this->pdo->prepare("INSERT INTO parametre (id_utilisateur, propriete, valeur) VALUES (?, ?, ?)");
      $stmt->execute([$id_utilisateur, $propriete, $valeur]);
    }
  }
}
