<?php
//controller de la deconnexion
// Ce fichier est utilisé pour gérer la déconnexion de l'utilisateur

namespace App\Controllers; //ajouter le namespace

class LogoutController
{
  public function logout()
  {
    session_unset();
    session_destroy();
    header('Location: /login');
    exit;
  }
}
