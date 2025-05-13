<!-- feuille de code qui gére le démarrage de la session -->
<?php
// configurer la durée de vie de la session à 1 heure (3600 secondes)
ini_set('session.gc_maxlifetime', 3600);
ini_set('session.gc_probability', 1);            // 1 chance sur...
ini_set('session.gc_divisor', 1000);             // ...1000 (donc très rare)
session_set_cookie_params(3600);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
