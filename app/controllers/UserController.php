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

  /**
   * Traite le formulaire registerUser.
   */
  public function registerUser()
  {
    // Si on est en POST, on traite la soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupération et assainissement
      $pseudo       = htmlspecialchars($_POST['pseudo']);
      $nom          = htmlspecialchars($_POST['nom']);
      $prenom       = htmlspecialchars($_POST['prenom']);
      $email        = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $motDePasse   = $_POST['mot_de_passe'];

      // Validation simple
      if (!$email) {
        $error = "Email invalide.";
      } else if (empty($motDePasse)) {
        $error = "Le mot de passe ne peut pas être vide.";
      } else {
        // Hash du mot de passe
        $hashed = password_hash($motDePasse, PASSWORD_DEFAULT);

        // On appelle le modèle
        $model = new User();
        $created = $model->createUser($pseudo, $nom, $prenom, $email, $hashed);

        if ($created) {
          // tout est bon redirection vers la page de login
          $success = "Votre profil a été créé avec succès. Vous pouvez maintenant vous connecter.";
          $old = []; // pour vider les champs
        } else {
          $error = "Cet email est déjà utilisé.";
        }
      }
    }
    render(
      __DIR__ . '/../views/pages/registerUser.php',
      [
        'title' => 'Créer votre profil',
        'error'   => $error   ?? null, //variable qui sert a affihcer les messages d'erreurs
        'success' => $success ?? null, //pareil mais pour le succes
        'old'     => $_POST   ?? [] //sert à conserver les données que l’utilisateur a déjà saisies pour les réafficher automatiquement si une erreur survient.
      ]
    );
  }

  /**
   * Traite le formulaire registerEmploye.
   */
  public function registerEmploye()
  {
    // Si on est en POST, on traite la soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupération et assainissement
      $pseudo       = htmlspecialchars($_POST['pseudo']);
      $nom          = htmlspecialchars($_POST['nom']);
      $prenom       = htmlspecialchars($_POST['prenom']);
      $poste        = htmlspecialchars($_POST['poste']);
      $numeroBadge  = htmlspecialchars($_POST['numero_badge']);
      $email        = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      $motDePasse   = $_POST['mot_de_passe'];

      // Validation simple
      if (!$email) {
        $error = "Email invalide.";
      } else if (empty($motDePasse)) {
        $error = "Le mot de passe ne peut pas être vide.";
      } else {
        // Hash du mot de passe
        $hashed = password_hash($motDePasse, PASSWORD_DEFAULT);

        // On appelle le modèle
        $model = new User();
        $created = $model->createEmploye($pseudo, $nom, $prenom, $email, $hashed, $poste, $numeroBadge);

        if ($created) {
          // tout est bon redirection vers la page de login
          $success = "Le profil de l'employé a été créé avec succès. Il peut maintenant se connecter.";
          $old = []; // pour vider les champs
        } else {
          $error = "Cet email est déjà utilisé.";
        }
      }
    }
    render(
      __DIR__ . '/../views/pages/administration/registerEmploye.php',
      [
        'title' => 'Créer un profil employes',
        'error'   => $error   ?? null, //variable qui sert a affihcer les messages d'erreurs
        'success' => $success ?? null, //pareil mais pour le succes
        'old'     => $_POST   ?? [] //sert à conserver les données que l’utilisateur a déjà saisies pour les réafficher automatiquement si une erreur survient.
      ]
    );
  }
}
