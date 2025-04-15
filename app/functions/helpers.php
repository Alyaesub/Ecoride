<?php

//Cette fonction :sécurise l’URL avec htmlentities, encode proprement la valeur de page, évite les copier-coller dans le HTML
// et permet de changer facilement la structure de l’URL si besoin.
function route(string $page): string
{
  return htmlentities("index.php?page=" . urlencode($page));
}
