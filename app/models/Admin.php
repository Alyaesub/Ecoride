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
  public function getAllEmployer()
  {
    $sql = "SELECT id_utilisateur, nom, prenom, email, actif FROM utilisateur WHERE id_role = 2";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll();
  }
}
