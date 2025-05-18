<?php

namespace App\Models;

use App\Models\ConnexionDb;
use PDO;

class Marque
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }

  /**
   * Récupère toutes les marques.
   */
  public function findAll(): array
  {
    $sql = "SELECT * FROM marque ORDER BY nom_marque ASC";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
