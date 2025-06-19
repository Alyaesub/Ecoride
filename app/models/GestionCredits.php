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
   * methode qui recupére le solde en bdd
   */
  public function getCredits(int $id_utilisateur): int
  {
    $stmt = $this->pdo->prepare("SELECT credits FROM utilisateur WHERE id_utilisateur = :id");
    $stmt->execute(['id' => $id_utilisateur]);
    return (int) $stmt->fetchColumn();
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
   * methode qui débite un utilisateur
   */
  public function debiterCredits(int $id_utilisateur, int $montant): bool
  {
    $stmt = $this->pdo->prepare("UPDATE utilisateur SET credits = credits - :montant WHERE id_utilisateur = :id");
    return $stmt->execute([
      'montant' => $montant,
      'id' => $id_utilisateur
    ]);
  }

  /**
   * methode qui gére le versement des credit au chauffeur
   */
  public function crediterChauffeur($idCovoit): bool
  {
    // Récupère le chauffeur du covoit
    $stmt = $this->pdo->prepare("SELECT id_utilisateur FROM covoiturage WHERE id_covoiturage = :id");
    $stmt->execute(['id' => $idCovoit]);
    $chauffeurId = $stmt->fetchColumn();

    if (!$chauffeurId) {
      return false;
    }

    // Récupère le total à verser (transactions en attente pour le chauffeur)
    $stmt = $this->pdo->prepare("
    SELECT SUM(montant) FROM transaction 
    WHERE id_covoiturage = :id AND type = 'chauffeur' AND statut = 'en_attente'
  ");
    $stmt->execute(['id' => $idCovoit]);
    $total = (int) $stmt->fetchColumn();

    if ($total <= 0) {
      return false;
    }

    // Créditer le chauffeur
    $stmt = $this->pdo->prepare("UPDATE utilisateur SET credits = credits + :somme WHERE id_utilisateur = :id");
    $stmt->execute([
      'somme' => $total,
      'id' => $chauffeurId
    ]);

    // Mettre à jour les transactions
    $stmt = $this->pdo->prepare("
    UPDATE transaction 
    SET statut = 'validée' 
    WHERE id_covoiturage = :id AND type = 'chauffeur' AND statut = 'en_attente'
  ");
    return $stmt->execute(['id' => $idCovoit]);
  }

  /**
   * methode qui crée un transaction dan sla table étransaction"
   */
  public function creerTransaction(
    int $idReceveur,
    int $idPassager,
    int $idCovoit,
    int $montant,
    string $type,
    string $statut = 'en_attente'
  ): bool {
    $stmt = $this->pdo->prepare("
    INSERT INTO transaction (
      id_utilisateur,
      id_passager,
      id_covoiturage,
      montant,
      type,
      statut
    ) VALUES (
      :receveur,
      :passager,
      :covoit,
      :montant,
      :type,
      :statut
    )
  ");

    return $stmt->execute([
      'receveur' => $idReceveur,
      'passager' => $idPassager,
      'covoit' => $idCovoit,
      'montant' => $montant,
      'type' => $type,
      'statut' => $statut
    ]);
  }

  /**
   * methode qui recupére l'admin
   */
  public function getIdAdmin(): ?int
  {
    $stmt = $this->pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE id_role = 1 LIMIT 1");
    $stmt->execute();
    return $stmt->fetchColumn() ?: null;
  }
}
