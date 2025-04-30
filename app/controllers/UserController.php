<?php
//feuille de code pour l'objet userController avec les methodes de la page de connexion et de la page de profils
namespace App\Controllers;


class UserController
{
  /**
   * Affiche la page de connexion (le formulaire).
   */
  public function showLoginForm()
  {
    // Charger la vue du formulaire de connexion
    require __DIR__ . '/../views/pages/login.php';
  }

  /**
   * Traite le formulaire de connexion.
   */
  public function login()
  {
    session_start();
    // 1. Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 2. Vérifier l'authentification (via modèle User ou autre)
    /* $user = User::checkCredentials($pseudo, $email, $password); */

    // 3. Si OK, enregistrer en session et rediriger vers le profil
    if ($pseudo === 'pseudo test' && $email === 'test@test.com' && $password === '1234') {
      $_SESSION['user_id'] = "userId"; // par exemple
      header('Location: /app/views/pages/profilUsers.php');
      exit;
    } else {
      // Gérer l'erreur (rester sur la page ou afficher un message)
      header('Location: /connexion?error=1');
      exit;
    }
    /* echo "Tentative de connexion avec l'utilisateur : $username";

    try {
      $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $pseudoForm = $_POST['pseudo'];
      $emailForm = $_POST['email'];
      $passwordForm = $_POST['password'];

      // Vérifier que l'email est valide
      if (!filter_var($emailForm, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide";
        exit();
      }
        
/////////////mettre la requete sql dans model en fais une classe user

      //Récupérer les utilisateurs 
      $query = "SELECT * FROM users WHERE email = :email";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':email', $emailForm);
      $stmt->execute();


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
    }*/
  }

  /**
   * Affiche la page de profil pour l'utilisateur connecté.
   */
  public function showProfile()
  {
    session_start();
    // Vérifier si l’utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
      // Rediriger vers la connexion s’il n’est pas logué
      header('Location: /login');
      exit;
    }
    // Récupérer les infos de l’utilisateur si besoin
    /* $user = User::find($_SESSION['user_id']); */

    // Charger la vue du profil
    require __DIR__ . '/../views/profilUsers.php';
  }
}
