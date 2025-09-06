<?php
// Nouvelle version (.env avec phpdotenv)
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Debug
if (!empty($_ENV['DEBUG']) && $_ENV['DEBUG'] === 'true') {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Env
define('APP_ENV', $_ENV['APP_ENV'] ?? 'local');
