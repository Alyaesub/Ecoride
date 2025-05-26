<?php
// Connexion à la base de données syntaxe a utiliser $pdo = ConnexionDb::getPdo();
// Ce fichier est utilisé pour établir une connexion à la base de données
namespace App\Models;

use PDO;

class ConnexionDb
{
  private static ?PDO $pdo = null;

  public static function getPdo(): PDO
  {
    if (self::$pdo === null) {
      $configPath = __DIR__ . '/../../config/env.ini';

      if (!file_exists($configPath)) {
        throw new \Exception("Configuration de la base de données manquante.");
      }

      $config = parse_ini_file($configPath, true);

      if (!isset($config['database'])) {
        throw new \Exception("Section [database] introuvable dans env.ini");
      }

      $db = $config['database'];

      $dsn = "mysql:host={$db['DB_HOST']};port={$db['DB_PORT']};dbname={$db['DB_NAME']};charset=utf8mb4";

      self::$pdo = new PDO($dsn, $db['DB_USER'], $db['DB_PASS'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    }

    return self::$pdo;
  }
}
