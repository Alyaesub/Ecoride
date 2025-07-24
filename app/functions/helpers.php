<?php

//Cette fonction :sécurise l’URL avec htmlentities, encode proprement la valeur de page, évite les copier-coller dans le HTML
// et permet de changer facilement la structure de l’URL si besoin.
function route(string $page): string
{
  return htmlentities(urlencode($page));
}
// middlewires
//function qui verifie l'eta de connexion de l'user peut servire pour remplacer
function requireLogin(): void
{
  if (!isset($_SESSION['user_id'])) {
    header('Location: ' . route('login'));
    exit;
  }
}

//function qui verifie si ces bien l'admin
function requireAdmin(): void
{
  // Vérifie que l'utilisateur est connecté
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['user']['id_role'])) {
    header('Location: ' . route('login'));
    exit;
  }

  // Vérifie que le rôle est bien "admin"
  if ($_SESSION['user']['id_role'] !== 1) {
    // Rediriger vers l’accueil
    header('Location: ' . route('home'));
    exit;
  }
}

//function qui verifie si ces bien un employer
function requireEmploye(): void
{
  // Vérifie que l'utilisateur est connecté
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['user']['id_role'])) {
    header('Location: ' . route('login'));
    exit;
  }

  // Vérifie que le rôle est bien "admin"
  if ($_SESSION['user']['id_role'] !== 2) {
    // Rediriger vers l’accueil
    header('Location: ' . route('home'));
    exit;
  }
}

//verifie si un compte est actif ou suspendu
function requireActif(): void
{
  if (!isset($_SESSION['user']) || $_SESSION['user']['actif'] != 1) {
    $_SESSION['error'] = "Votre compte est suspendu.";
    header('Location: ' . route('logout'));
    exit;
  }
}
