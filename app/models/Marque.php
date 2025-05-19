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
   * fonction pour créé la marque en bdd
   */
  public function create(string $nom): int
  {
    $stmt = $this->pdo->prepare("INSERT INTO marque (nom_marque) VALUES (:nom)");
    $stmt->execute(['nom' => $nom]);
    return (int) $this->pdo->lastInsertId();
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

  /**
   * fonction qui recupére la marque par le nom
   */
  public function findByName(string $nom): ?array
  {
    $sql = "SELECT * FROM marque WHERE LOWER(nom_marque) = LOWER(:nom) LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['nom' => $nom]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ?: null;
  }
}
