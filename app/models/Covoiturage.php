<?php

namespace App\Models;

use App\Models\ConnexionDb;
use PDO;

class Covoiturage
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }

  /**
   * crée un nouveau covoit et retourne son id
   */
  public function create(array $data): int
  {
    $stmt = $this->pdo->prepare("
      INSERT INTO covoiturage (
        id_utilisateur, id_vehicule, adresse_depart, adresse_arrivee,
        date_depart, date_arrivee, prix_personne, places_disponibles,
        est_ecologique, animaux_autorises, fumeur, statut
      ) VALUES (
        :id_utilisateur, :id_vehicule, :adresse_depart, :adresse_arrivee,
        :date_depart, :date_arrivee, :prix_personne, :places_disponibles,
        :est_ecologique, :animaux_autorises, :fumeur, :statut
      )
    ");

    $stmt->execute([
      'id_utilisateur' => $data['id_utilisateur'],
      'id_vehicule' => $data['id_vehicule'],
      'adresse_depart' => $data['adresse_depart'],
      'adresse_arrivee' => $data['adresse_arrivee'],
      'date_depart' => $data['date_depart'],
      'date_arrivee' => $data['date_arrivee'],
      'prix_personne' => $data['prix_personne'],
      'places_disponibles' => $data['places_disponibles'],
      'est_ecologique' => $data['est_ecologique'],
      'animaux_autorises' => $data['animaux_autorises'],
      'fumeur' => $data['fumeur'],
      'statut' => 'actif'
    ]);

    return $this->pdo->lastInsertId();
  }

  /**
   * ajout l'utilisateur et son role au covoit
   */
  public function lierUtilisateur(int $id_utilisateur, int $id_covoiturage, string $role): void
  {
    $stmt = $this->pdo->prepare("INSERT INTO user_covoiturage (id_utilisateur, id_covoiturage, role_utilisateur)
    VALUE (:id_utilisateur, :id_covoiturage, :role_utilisateur)
    ");

    $stmt->execute([
      'id_utilisateur' => $id_utilisateur,
      'id_covoiturage' => $id_covoiturage,
      'role_utilisateur' => $role
    ]);
  }

  /**
   * fonction qui recupére le vehicule pour le mettre dans le covoit
   */
  public function getVehiculeByUser(int $id_utilisateur): ?int
  {
    $stmt = $this->pdo->prepare("SELECT id_vehicule FROM vehicule WHERE id_utilisateur = :id LIMIT 1");
    $stmt->execute(['id' => $id_utilisateur]);
    $vehicule = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $vehicule ? $vehicule['id_vehicule'] : null;
  }

  /**
   * fonction qui recuépre les covoit pour chauqe user et son role 
   */
  public function getCovoitAndRoleByUser(int $id_utilisateur): array
  {
    $stmt = $this->pdo->prepare("SELECT c.*, uc.role_utilisateur
    FROM covoiturage c
    JOIN user_covoiturage uc ON c.id_covoiturage = uc.id_covoiturage
    WHERE uc.id_utilisateur = :id AND c.statut NOT IN ('annule', 'termine')
    ORDER BY c.date_depart DESC");
    $stmt->execute(['id' => $id_utilisateur]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  /**
   * function qui supprime le covoit en bdd
   */
  public function supprimeCovoit(int $id): void
  {
    // Supprime d’abord les liens dans user_covoiturage (clé étrangère)
    $this->pdo->prepare("DELETE FROM user_covoiturage WHERE id_covoiturage = :id")
      ->execute(['id' => $id]);

    // Supprime ensuite le covoiturage
    $this->pdo->prepare("DELETE FROM covoiturage WHERE id_covoiturage = :id")
      ->execute(['id' => $id]);
  }

  /**
   * function qui gére la recherhce pour le formCovoit page voyage
   */
  public function rechercherCovoiturages(array $filters): array
  {
    $conditions = ["statut = 'actif'"];
    $params = [];
    if (!empty($filters['adresse_depart'])) {
      $conditions[] = 'adresse_depart = :adresse_depart';
      $params['adresse_depart'] = $filters['adresse_depart'];
    }
    if (!empty($filters['adresse_arrivee'])) {
      $conditions[] = 'adresse_arrivee = :adresse_arrivee';
      $params['adresse_arrivee'] = $filters['adresse_arrivee'];
    }
    if (!empty($filters['date_depart'])) {
      $conditions[] = 'DATE(date_depart) = :date_depart';
      $params['date_depart'] = $filters['date_depart'];
    }
    $sql = "SELECT * FROM covoiturage";
    if (!empty($conditions)) {
      $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAdressesDepart(): array
  {
    $stmt = $this->pdo->query("SELECT DISTINCT adresse_depart AS nom FROM covoiturage");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $index => $row) {
      $results[$index]['id'] = $index + 1;
    }
    return $results;
  }

  public function getAdressesArrivee(): array
  {
    $stmt = $this->pdo->query("SELECT DISTINCT adresse_arrivee AS nom FROM covoiturage");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $index => $row) {
      $results[$index]['id'] = $index + 1;
    }
    return $results;
  }

  public function getDatesDepart(): array
  {
    $stmt = $this->pdo->query("SELECT DISTINCT DATE(date_depart) AS date_depart FROM covoiturage ORDER BY date_depart ASC");
    return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'date_depart');
  }

  /**
   * function qui gére la recherche pour la searchBAr
   */
  public function searchCitiesBar(string $motCle): array
  {
    $sql = "SELECT * FROM covoiturage
            WHERE statut = 'actif'
            AND date_depart >= NOW()
            AND (adresse_depart LIKE :motCle
              OR adresse_arrivee LIKE :motCle)
            ORDER BY date_depart ASC
            LIMIT 10";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      'motCle' => '%' . $motCle . '%'
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * methode qui gére pour la recherche de covoit part l'id user pour detailsCovit
   */
  public function findById(int $id): ?array
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
    SELECT c.*, u.pseudo AS pseudo_conducteur
    FROM covoiturage c
    JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur
    WHERE c.id_covoiturage = :id
  ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
  }

  /**
   * methode qui gére la rehcerche des passager via l'id covoit
   */
  public function getPassagersByCovoiturage($id_covoit): array
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("
    SELECT u.pseudo
    FROM user_covoiturage uc
    JOIN utilisateur u ON uc.id_utilisateur = u.id_utilisateur
    WHERE uc.id_covoiturage = ?
  ");
    $stmt->execute([$id_covoit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * methode qui gére la modif des covoit
   */
  public function updateById(int $id, array $data): void
  {
    $pdo = ConnexionDb::getPdo();

    $stmt = $pdo->prepare("
      UPDATE covoiturage 
      SET 
        adresse_depart = :adresse_depart,
        adresse_arrivee = :adresse_arrivee,
        date_depart = :date_depart,
        date_arrivee = :date_arrivee,
        prix_personne = :prix_personne,
        places_disponibles = :places_disponibles,
        est_ecologique = :est_ecologique,
        animaux_autorises = :animaux_autorises,
        fumeur = :fumeur
      WHERE id_covoiturage = :id
    ");

    $stmt->execute([
      'adresse_depart' => $data['adresse_depart'],
      'adresse_arrivee' => $data['adresse_arrivee'],
      'date_depart' => $data['date_depart'],
      'date_arrivee' => $data['date_arrivee'],
      'prix_personne' => $data['prix_personne'],
      'places_disponibles' => $data['places_disponibles'],
      'est_ecologique' => isset($data['est_ecologique']) ? 1 : 0,
      'animaux_autorises' => isset($data['animaux_autoriser']) ? 1 : 0,
      'fumeur' => isset($data['fumeur']) ? 1 : 0,
      'id' => $id
    ]);
  }

  /**
   * methode qui change le statut du covoit (actif, anuller,terminer)
   */
  public function updateStatut($id, $nouveauStatut)
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->prepare("UPDATE covoiturage SET statut = :statut WHERE id_covoiturage = :id");
    $stmt->bindParam(':statut', $nouveauStatut);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  /**
   * methode qui gére l'historique (annuler terminer) des covoit
   */
  public function getHistoriqueCovoiturages($id_utilisateur)
  {
    $pdo = ConnexionDb::getPdo();

    $sql = "
    SELECT c.*
    FROM covoiturage c
    INNER JOIN user_covoiturage uc ON c.id_covoiturage = uc.id_covoiturage
    WHERE uc.id_utilisateur = :id_utilisateur
      AND (c.statut = 'termine' OR c.statut = 'annule')
    ORDER BY c.date_depart DESC
  ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_utilisateur' => $id_utilisateur]);
    return $stmt->fetchAll();
  }

  /**
   * methode qui gére la participation
   */
  public function verifieParticipation(int $id_utilisateur, int $id_covoiturage): bool
  {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_covoiturage WHERE id_utilisateur = :user AND id_covoiturage = :covoit");
    $stmt->execute([
      'user' => $id_utilisateur,
      'covoit' => $id_covoiturage
    ]);
    return $stmt->fetchColumn() > 0;
  }

  /**
   * methode qui supprime la participation d'un passager
   */
  public function supprimerParticipation(int $id_utilisateur, int $id_covoiturage): void
  {
    $stmt = $this->pdo->prepare("
    DELETE FROM user_covoiturage
    WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage
  ");
    $stmt->execute([
      'id_utilisateur' => $id_utilisateur,
      'id_covoiturage' => $id_covoiturage
    ]);
  }

  /**
   * methode qui decrémente le nombre de place dispo
   */
  public function decrementePlacesDispo(int $id_covoiturage): bool
  {
    $stmt = $this->pdo->prepare("
    UPDATE covoiturage 
    SET places_disponibles = places_disponibles - 1 
    WHERE id_covoiturage = :id AND places_disponibles > 0
  ");
    return $stmt->execute(['id' => $id_covoiturage]);
  }

  /**
   * methode qui incrémente le nombre de place en cas d'annulation de participation
   */
  public function incrementePlacesDispo(int $id_covoiturage): void
  {
    $stmt = $this->pdo->prepare("
    UPDATE covoiturage 
    SET places_disponibles = places_disponibles + 1 
    WHERE id_covoiturage = :id
  ");
    $stmt->execute(['id' => $id_covoiturage]);
  }

  /**
   * Récupère les infos d’un covoiturage + le rôle du user connecté + le pseudo du conducteur
   */
  public function getCovoitWithRoleById(int $id_covoiturage, int $id_utilisateur): ?array
  {
    $stmt = $this->pdo->prepare("
      SELECT c.*, uc.role_utilisateur, u.pseudo AS pseudo_conducteur
      FROM covoiturage c
      JOIN user_covoiturage uc ON c.id_covoiturage = uc.id_covoiturage
      JOIN utilisateur u ON u.id_utilisateur = c.id_utilisateur
      WHERE c.id_covoiturage = :id_covoit AND uc.id_utilisateur = :id_user
    ");
    $stmt->execute([
      'id_covoit' => $id_covoiturage,
      'id_user' => $id_utilisateur
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
  }
  /**
   * methode pour les covoit populair dans le home
   */
  public function getCovoituragesPopulaires(): array
  {
    $pdo = ConnexionDb::getPdo();
    $stmt = $pdo->query("
    SELECT * FROM covoiturage
    WHERE statut = 'actif'
    ORDER BY RAND()
    LIMIT 5
  ");
    return $stmt->fetchAll();
  }
}
