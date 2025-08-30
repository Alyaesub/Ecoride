<?php

namespace App\Models;

use PDO;

class Litige
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }


  //methode qui recup tous les covoit en litige
  public function getAllLitiges()
  {
    $sql = "SELECT * FROM covoiturage WHERE statut = 'litige'";
    return $this->pdo->query($sql)->fetchAll();
  }
  //methiode qui recup les details du covoit en litige
  public function getDetailsLitige($id)
  {
    $sql = "SELECT c.*, u1.pseudo AS chauffeur, u2.pseudo AS passager
            FROM covoiturage c
            LEFT JOIN user_covoiturage uc1 ON c.id_covoiturage = uc1.id_covoiturage AND uc1.role_utilisateur = 'conducteur'
            LEFT JOIN utilisateur u1 ON uc1.id_utilisateur = u1.id_utilisateur
            LEFT JOIN user_covoiturage uc2 ON c.id_covoiturage = uc2.id_covoiturage AND uc2.role_utilisateur = 'passager'
            LEFT JOIN utilisateur u2 ON uc2.id_utilisateur = u2.id_utilisateur
            WHERE c.id_covoiturage = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }
  //methode qui change le status du covoit une fois géré le litge
  public function resoudreLitige($id, $nouveauStatut)
  {
    $sql = "UPDATE covoiturage SET statut = :statut WHERE id_covoiturage = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      'statut' => $nouveauStatut,
      'id' => $id
    ]);
  }

  // récupérer les avis associés au covoit
  public function getAvisPourLitige($id_covoit): array
  {
    $avisModel = new \App\Models\Avis();
    $collection = $avisModel->getCollection();
    if ($collection === null) {
      return []; // Mongo non connecté
    }
    try {
      $cursor = $collection->find(['id_covoiturage' => intval($id_covoit)]);
      $avis = [];
      foreach ($cursor as $doc) {
        $avis[] = [
          'commentaire' => $doc['commentaire'] ?? '',
          'date' => $doc['date']?->toDateTime()->format('d/m/Y H:i') ?? '',
        ];
      }
      return $avis;
    } catch (\Throwable $e) {
      error_log("Erreur récupération avis litige : " . $e->getMessage());
      return [];
    }
  }
}
