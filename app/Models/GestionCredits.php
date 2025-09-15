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
    $stmt->execute(['id' => $idCovoit]);
    return $total;
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

  /**
   * methode qui recuéper les passager du covoit mes par id pour le mailing
   */
  public function getPassagersByCovoitId(int $id_covoit): array
  {
    $stmt = $this->pdo->prepare("
    SELECT u.id_utilisateur, u.prenom, u.email
    FROM user_covoiturage uc
    JOIN utilisateur u ON uc.id_utilisateur = u.id_utilisateur
    WHERE uc.id_covoiturage = ? AND uc.role_utilisateur = 'passager'
  ");
    $stmt->execute([$id_covoit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  /**
   * methode qui recupere l'id du xhauffeur pour le mailing
   */
  public function getChauffeurByCovoitId(int $id_covoit): array
  {
    $stmt = $this->pdo->prepare("
    SELECT u.id_utilisateur, u.email, u.prenom
    FROM covoiturage c
    JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur
    WHERE c.id_covoiturage = ?
  ");
    $stmt->execute([$id_covoit]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * methode qui recupere le total des credit d'un covoit pour les afficher dans le mailing
   */
  public function getMontantTotalCredite(int $idCovoit): int
  {
    $stmt = $this->pdo->prepare("
    SELECT SUM(montant)
    FROM transaction
    WHERE id_covoiturage = :id AND type = 'chauffeur' AND statut = 'validée'
  ");
    $stmt->execute(['id' => $idCovoit]);
    return (int) $stmt->fetchColumn();
  }

  /**
   * methode pour gére le remboursement de TOUS les passager d'un covoit (annuler ou supprimé)
   */
  public function rembourseAllPassagers($id_covoit): bool
  {
    // Récupère toutes les transactions concernées
    $stmt = $this->pdo->prepare("
    SELECT id_transaction, id_passager, montant 
    FROM transaction 
    WHERE id_covoiturage = :id 
      AND (
        statut = 'en_attente' 
        OR (type = 'plateforme' AND statut = 'validée')
      )
  ");
    $stmt->execute(['id' => $id_covoit]);
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Regroupe les montants à rembourser par passager
    $remboursements = [];

    foreach ($transactions as $t) {
      $id = $t['id_passager'];
      $montant = (int) $t['montant'];

      if (!isset($remboursements[$id])) {
        $remboursements[$id] = 0;
      }

      $remboursements[$id] += $montant;

      // Marque la transaction comme remboursée
      $stmtUpdate = $this->pdo->prepare("
      UPDATE transaction 
      SET statut = 'remboursée' 
      WHERE id_transaction = :id
    ");
      $stmtUpdate->execute(['id' => $t['id_transaction']]);
    }

    // Rembourse les crédits à chaque passager
    foreach ($remboursements as $id_passager => $montantTotal) {
      $this->ajouterCredits($id_passager, $montantTotal);
    }

    return true;
  }

  /**
   * methode qui gére le rembousement d'un user unique (genre annuleParticipation)
   */
  public function remboursePassagerUnique($id_utilisateur, $id_covoit): bool
  {
    // Récupère les transactions à rembourser
    $stmt = $this->pdo->prepare("
    SELECT id_transaction, montant 
    FROM transaction 
    WHERE id_covoiturage = :id 
      AND id_passager = :passager
      AND (
        statut = 'en_attente' 
        OR (type = 'plateforme' AND statut = 'validée')
      )
  ");
    $stmt->execute([
      'id' => $id_covoit,
      'passager' => $id_utilisateur
    ]);
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Rembourse chaque transaction
    foreach ($transactions as $t) {
      $this->ajouterCredits($id_utilisateur, (int) $t['montant']);

      // Marque la transaction comme remboursée
      $stmtUpdate = $this->pdo->prepare("
      UPDATE transaction 
      SET statut = 'remboursée' 
      WHERE id_transaction = :id
    ");
      $stmtUpdate->execute(['id' => $t['id_transaction']]);
    }

    return true;
  }
}
