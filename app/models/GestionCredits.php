<?php

namespace App\Models;

use App\Models\ConnexionDb;
use PDO;

class GestionCredits
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }
  /**
   * methode qui ajoute des credits apres "paiment"
   */
  public function ajouterCredits(int $idUser, int $nbCredits): bool
  {
    $stmt = $this->pdo->prepare("UPDATE utilisateur SET credits = credits + :credits WHERE id_utilisateur = :id");
    return $stmt->execute([
      'credits' => $nbCredits,
      'id' => $idUser
    ]);
  }

  /**
   * methode qui gére le versement des credit au chauffeur
   */
  public function crediterChauffeur($idCovoit)
  {
    //Récupère le nombre de crédits à verser (exemple : 10)
    $stmt = $this->pdo->prepare("SELECT prix FROM covoiturage WHERE id_covoiturage = :id");
    $stmt->execute(['id' => $idCovoit]);
    $prix = $stmt->fetchColumn();

    //Récupère le chauffeur
    $stmt = $this->pdo->prepare("SELECT id_utilisateur FROM covoiturage WHERE id_covoiturage = :id");
    $stmt->execute(['id' => $idCovoit]);
    $chauffeurId = $stmt->fetchColumn();

    //Créditer le chauffeur
    $stmt = $this->pdo->prepare("UPDATE utilisateur SET credits = credits + :prix WHERE id_utilisateur = :chauffeur");
    $stmt->execute([
      'prix' => $prix,
      'chauffeur' => $chauffeurId
    ]);
  }
}
