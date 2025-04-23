<?php
//feuille de code pour l'objet userController avec les methodes de la page de connexion et de la page de profils
namespace App\Models;

class UserController
{
  /**
   * Affiche la page de connexion (le formulaire).
   */
  public function showLoginForm()
  {
    // Charger la vue du formulaire de connexion
    require __DIR__ . 'app\views\pages\login.php';
  }

  /**
   * Traite le formulaire de connexion.
   */
  public function login()
  {

    // 1. Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 2. Vérifier l'authentification (via ton modèle User ou autre)
    // $user = User::checkCredentials($email, $password);

    // 3. Si OK, enregistrer en session et rediriger vers le profil
    if ($pseudo === 'pseudo test' && $email === 'test@test.com' && $password === '1234') {
      $_SESSION['user_id'] = "userId"; // par exemple
      header('Location: /app/views/pages/login.php');
      exit;
    } else {
      // Gérer l'erreur (rester sur la page ou afficher un message)
      header('Location: /connexion?error=1');
      exit;
    }
  }

  /**
   * Affiche la page de profil pour l'utilisateur connecté.
   */
  public function showProfile()
  {
    // Vérifier si l’utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
      // Rediriger vers la connexion s’il n’est pas logué
      header('Location: /login');
      exit;
    }

    // Récupérer les infos de l’utilisateur si besoin
    // $user = User::find($_SESSION['user_id']);

    // Charger la vue du profil
    require __DIR__ . 'app/views/profilUsers.php';
  }
}
