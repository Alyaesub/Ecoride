<?php
//feuille de code pour l'objet userController avec les methodes de la page de connexion et de la page de profils
namespace App\Controllers;

use App\Models\User;

class UserController
{
  /**
   * Affiche la page de connexion (le formulaire).
   */
  public function showLoginForm()
  {
    // Charger la vue du formulaire de connexion
    render(__DIR__ . '/../views/pages/login.php', []);
  }

  /**
   * Traite le formulaire de connexion.
   */
  public function login()
  {
    $pseudo = $_POST['pseudo'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header('Location: /connexion?error=email');
      exit();
    }

    $userModel = new User();
    $user = $userModel->findByCredentials($email, $pseudo, $password);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
      $_SESSION['user_id'] = $user['id_utilisateur'];
      $_SESSION['user_role'] = $user['id_role'];
      $_SESSION['user'] = [
        'id' => $user['id_utilisateur'],
        'pseudo' => $user['pseudo'],
        'role' => $user['id_role']
      ];

      // Redirection selon le rôle
      switch ($user['id_role']) {
        case 1:
          header('Location: ' . route('dashboardAdmin'));
          break;
        case 2:
          header('Location: ' . route('dashboardEmploye'));
          break;
        case 3:
        default:
          header('Location: ' . route('profil'));
          break;
      }
      exit();
    } else {
      header('Location: /connexion?error=identifiants');
      exit();
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
      header('Location: ' . route('login'));
      exit;
    }
    // Récupérer les infos de l’utilisateur


    // Charger la vue du profil
    $userModel = new \App\Models\User();
    $user = $userModel->findById($_SESSION['user_id']);

    render(__DIR__ . '/../views/pages/profilUsers.php', [
      'user' => $user
    ]);
  }
}
