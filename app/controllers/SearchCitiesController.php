<?php
// Contrôleur qui gère les recherches de villes pour la searchbar (réponse en JSON)

namespace App\Controllers;

use App\Models\ConnexionDb;

class SearchCitiesController
{
  public function index()
  {
    /* // Connexion à la base de données via le modèle ConnexionDb
    $pdo = ConnexionDb::getPdo();

    // Vérifie si la connexion a échoué
    if (!$pdo) {
      http_response_code(500);
      echo json_encode(['error' => 'Connexion à la base de données échouée']);
      exit;
    }

    // Vérifie si le paramètre 'q' (la recherche) est bien passé
    if (isset($_GET['q'])) {
      $q = trim($_GET['q']); // Nettoie l'entrée utilisateur

      // Filtre les recherches trop courtes (moins de 2 caractères)
      if (strlen($q) < 2) {
        echo json_encode([]);
        exit;
      }

      // Prépare une requête SQL pour chercher dans les villes de départ et d'arrivée
      $stmt = $pdo->prepare("SELECT DISTINCT ville_depart AS name 
                            FROM covoiturages 
                            WHERE ville_depart LIKE :search 
                              OR ville_arrivee LIKE :search 
                            LIMIT 5");

      // Exécute la requête avec le paramètre de recherche
      $stmt->execute(['search' => "%$q%"]);
      $results = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif

      // Définit l'en-tête JSON pour la réponse
      header('Content-Type: application/json');
      echo json_encode($results); // Renvoie les résultats au format JSON
    } */

    // Fake data (remplacer la BDD pour tester)
    $fakeCities = [
      ['name' => 'Paris'],
      ['name' => 'Pau'],
      ['name' => 'Lyon'],
      ['name' => 'Marseille'],
      ['name' => 'Bordeaux']
    ];

    // Vérifie si le paramètre 'q' est passé
    if (isset($_GET['q'])) {
      $q = trim($_GET['q']); // Nettoie l'entrée utilisateur

      // Filtre les recherches trop courtes
      if (strlen($q) < 2) {
        echo json_encode([]);
        exit;
      }

      // Filtre les fake cities par rapport à la recherche
      $filtered = array_filter($fakeCities, function ($city) use ($q) {
        return strpos(strtolower($city['name']), strtolower($q)) !== false;
      });

      // Renvoie les résultats filtrés en JSON
      header('Content-Type: application/json');
      echo json_encode(array_values($filtered)); // Réindexe le tableau pour JSON
    }
  }
}
