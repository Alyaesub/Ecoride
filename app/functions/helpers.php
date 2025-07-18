<?php

//Cette fonction :sécurise l’URL avec htmlentities, encode proprement la valeur de page, évite les copier-coller dans le HTML
// et permet de changer facilement la structure de l’URL si besoin.
function route(string $page): string
{
  return htmlentities(urlencode($page));
}

//function qui verifie l'eta de connexion de l'user peut servire pour remplacer
function requireLogin(): void
{
  if (!isset($_SESSION['user_id'])) {
    header('Location: ' . route('login'));
    exit;
  }
}
