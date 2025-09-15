<?php

/**
 * configurer la durée de vie de la session à 1 heure (3600 secondes)
 * et gestion des token csrf
 */
ini_set('session.gc_maxlifetime', 3600);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1000);
session_set_cookie_params(3600);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Génération d’un token CSRF
function generateCsrfToken(): string
{
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf_token'];
}

// Vérification d’un token CSRF
function verifyCsrfToken(string $token): bool
{
  return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
