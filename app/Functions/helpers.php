<?php
//Cette fonction :sécurise l’URL avec htmlentities, encode proprement la valeur de page, évite les copier-coller dans le HTML
// et permet de changer facilement la structure de l’URL si besoin.
function route(string $page): string
{
  return htmlentities(urlencode($page));
}
// middlewires
//function qui verifie l'eta de connexion de l'user 
function requireLogin(): void
{
  if (!isset($_SESSION['user_id'])) {
    header('Location: ' . route('login'));
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
