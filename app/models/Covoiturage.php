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
        est_ecologique, animaux_autorises, fumeur, est_annule
      ) VALUES (
        :id_utilisateur, :id_vehicule, :adresse_depart, :adresse_arrivee,
        :date_depart, :date_arrivee, :prix_personne, :places_disponibles,
        :est_ecologique, :animaux_autorises, :fumeur, 0
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
      'fumeur' => $data['fumeur']
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
    WHERE uc.id_utilisateur = :id AND c.est_annule = 0
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
    $conditions = [];
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
            WHERE adresse_depart LIKE :motCle
              OR adresse_arrivee LIKE :motCle
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
}
