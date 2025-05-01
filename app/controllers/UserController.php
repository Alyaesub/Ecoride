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
    // 1. Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 2. Vérifier l'authentification via le modèle User
    /* $userModel = new User();
    $user = $userModel->findByCredentials($email, $pseudo, $password); */

    // 3. Si OK, enregistrer en session et rediriger vers le profil
    if ($pseudo === 'bob' && $email === 'bob@test.com' && $password === 'password123') {
      $_SESSION['user_id'] = "userId"; // par exemple
      header('Location: ' . route('profil'));
      exit;
    } else {
      // Gérer l'erreur (rester sur la page ou afficher un message)
      header('Location: /connexion?error=1');
      exit;
    }
    /* echo "Tentative de connexion avec l'utilisateur : $username";

    try {
      $pdo = $pdo = ConnexionDb::getPdo();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $pseudoForm = $_POST['pseudo'];
      $emailForm = $_POST['email'];
      $passwordForm = $_POST['password'];

      // Vérifier que l'email est valide
      if (!filter_var($emailForm, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide";
        exit();
      }

      //Est-ce que l’utilisateur (mail) existe ?
      if ($stmt->rowCount() == 1) {
        $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($passwordForm, $monUser['password'])) {
          // Stocker les informations de l'utilisateur en session
          $_SESSION['user'] = $monUser;
          // Redirection vers la page du compte
          header("Location: /views/profilUsers.php");
          exit();
        } else {
          echo "Mot de passe incorrect";
        }
      } else {
        echo "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
      }
    } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
    } */
  }

  /**
   * Affiche la page de profil pour l'utilisateur connecté.
   */
  public function showProfile()
  {

    // Vérifier si l’utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
      // Rediriger vers la connexion s’il n’est pas logué
      header('Location: ?page=login');
      exit;
    }
    // Récupérer les infos de l’utilisateur si besoin
    /* $user = User::find($_SESSION['user_id']); */

    // Charger la vue du profil

    render(__DIR__ . '/../views/pages/profilUsers.php', []);
  }
}
