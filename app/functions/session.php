<!-- feuille de code qui gére le démarrage de la session -->
<?php
// configurer la durée de vie de la session à 1 heure (3600 secondes)
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
