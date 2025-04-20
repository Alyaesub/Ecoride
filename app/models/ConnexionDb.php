<?php
// Connexion à la base de données
// Ce fichier est utilisé pour établir une connexion à la base de données
namespace App\Models;

use PDO; //importation de la classe PDO pour la connexion à la base de données   

//classe pour la connexion à la base de données utilisée dans les controllers et les models 
class ConnexionDb
{
  public static function getPdo(): PDO
  {
    // Inclure le fichier de configuration globale
    require_once __DIR__ . '/../../config/config.php';

    // Vérifie que les informations de connexion existent dans la config
    if (!isset($config['database'])) {
      throw new \Exception("Configuration de la base de données manquante.");
    }

    // Récupère les paramètres depuis le tableau de configuration
    $host = $config['database']['DB_HOST'] ?? '127.0.0.1'; //les valeur apres la conditions ?? seront en enlever en mise en prod
    $dbname = $config['database']['DB_NAME'] ?? 'ecoride'; //les valeur apres la conditions ?? seront en enlever en mise en prod
    $user = $config['database']['DB_USER'] ?? 'root'; //les valeur apres la conditions ?? seront en enlever en mise en prod
    $pass = $config['database']['DB_PASS'] ?? 'root'; //les valeur apres la conditions ?? seront en enlever en mise en prod

    // Chaîne DSN pour PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

    // Crée et retourne l'objet PDO
    return new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
  }
}
