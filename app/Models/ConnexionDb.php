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
      // Nouvelle version (.env)
      $dsn = sprintf(
        "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
        $_ENV['DB_HOST'],
        $_ENV['DB_PORT'],
        $_ENV['DB_NAME']
      );

      self::$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
      //  Nouvelle version (.env)
      $dsn = sprintf(
        "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
        $_ENV['DB_HOST'],
        $_ENV['DB_PORT'],
        $_ENV['DB_NAME']
      );

      self::$pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    }

    return self::$pdo;
  }
}
