<?php

namespace App\Models;

use App\Models\ConnexionDb;
use PDO;

class Vehicule
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }

  /**
   * Récupère tous les véhicules d’un utilisateur avec le nom de la marque.
   */
  public function findAllByUserId(int $userId): array
  {
    $sql = "SELECT v.*, m.nom_marque 
            FROM vehicule v 
            JOIN marque m ON v.id_marque = m.id_marque 
            WHERE v.id_utilisateur = :id_utilisateur";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id_utilisateur' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Ajoute un nouveau véhicule.
   */
  public function create(array $data): void
  {
    $sql = "INSERT INTO vehicule (id_utilisateur, id_marque, modele, couleur, energie, immatriculation) 
            VALUES (:id_utilisateur, :id_marque, :modele, :couleur, :energie, :immatriculation)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      'id_utilisateur' => $data['id_utilisateur'],
      'id_marque' => $data['id_marque'],
      'modele' => $data['modele'],
      'couleur' => $data['couleur'],
      'energie' => $data['energie'],
      'immatriculation' => $data['immatriculation']
    ]);
  }

  /**
   * Supprime un véhicule
   */
  public function delete(int $idVehicule, int $userId): void
  {
    $sql = "DELETE FROM vehicule 
            WHERE id_vehicule = :id_vehicule 
            AND id_utilisateur = :id_utilisateur";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      'id_vehicule' => $idVehicule,
      'id_utilisateur' => $userId
    ]);
  }

  /**
   * methode qui recupére le vehicule utiliser pour un covoit
   */
  public function findWithMarqueById(int $idVehicule): array|false
  {
    $sql = "SELECT v.*, m.nom_marque
          FROM vehicule v
          JOIN marque m ON v.id_marque = m.id_marque
          WHERE v.id_vehicule = :id_vehicule";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id_vehicule' => $idVehicule]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * methode qui verifie si le vehicule appartient bien a l'user
   */
  public function checkVehiculeAppartientAUser($vehiculeId, $userId): bool
  {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM vehicule WHERE id_vehicule = :id AND id_utilisateur = :uid");
    $stmt->execute(['id' => $vehiculeId, 'uid' => $userId]);
    return $stmt->fetchColumn() > 0;
  }
}
