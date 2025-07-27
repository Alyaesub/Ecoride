<?php

namespace App\Models;

use PDO;

class Admin
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }
  //methode qui recup les employer en bdd
  public function getAllEmployes()
  {
    $sql = "SELECT id_utilisateur, nom, prenom, email, actif FROM utilisateur WHERE id_role = 2";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll();
  }

  //methode qui recupere les user pour les afficher dans le dashboard admin
  public function getAllUtilisateurs()
  {
    $sql = "SELECT id_utilisateur, nom, prenom, email, actif FROM utilisateur WHERE id_role = 3";
    return $this->pdo->query($sql)->fetchAll();
  }

  //methode qui change le statut des user (actif)
  public function toggleUser($id)
  {
    $sql = "UPDATE utilisateur SET actif = NOT actif WHERE id_utilisateur = :id AND id_role = 3";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  //methode qui change le statut d'un copt employer
  public function toggleActif($id)
  {
    $sql = "UPDATE utilisateur SET actif = NOT actif WHERE id_utilisateur = :id AND id_role = 2";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
