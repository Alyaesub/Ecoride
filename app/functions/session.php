<!-- feuille de code qui gére le démarrage de la session -->
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
