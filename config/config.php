<?php

/**
 * CONFIGURATION GLOBALE DU PROJET ECORIDE
 * Ce fichier lit les paramètres du fichier `env.ini`
 * et prépare l’environnement global (debug, constantes, etc.)
 */

// Initialise la variable de configuration
$config = [];

// Vérifie si le fichier env.ini existe dans le même dossier
if (file_exists(__DIR__ . '/env.ini')) {
  // Parse le fichier INI en tableau associatif avec sections
  $config = parse_ini_file(__DIR__ . '/env.ini', true);

  /**
   * SECTION DEBUG :
   * Si la clé DEBUG existe et vaut 'true', on active l'affichage des erreurs PHP
   * Cela est utile pendant le développement, mais doit être désactivé en production
   */
  if (!empty($config['settings']['DEBUG']) && $config['settings']['DEBUG'] === 'true') {
    ini_set('display_errors', 1);                // Affiche les erreurs à l'écran
    ini_set('display_startup_errors', 1);        // Affiche les erreurs de démarrage
    error_reporting(E_ALL);                      // Rapporte toutes les erreurs
  }

  /**
   * SECTION ENVIRONNEMENT :
   * On définit une constante globale APP_ENV, qui pourra être utilisée dans tout le projet
   * pour détecter si l'on est en 'local', 'production', etc.
   */
  if (!empty($config['settings']['APP_ENV'])) {
    define('APP_ENV', $config['settings']['APP_ENV']);
  }
} else {
  /**
   * CAS DE SECOURS :
   * Si le fichier env.ini est introuvable, on définit quand même un environnement par défaut
   */
  define('APP_ENV', 'local');
}
