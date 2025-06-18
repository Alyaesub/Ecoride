<?php
//feuille de code pour l'objet userController avec les methodes de la page de connexion et de la page de profils
namespace App\Controllers;

use App\Models\User;
use App\Models\Marque;
use App\Models\Vehicule;
use App\Models\Covoiturage;
use App\Models\Notation;


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
    //récupere les donné des vehicules pour l'afficher dans la view
    $vehiculeModel = new Vehicule();
    $marqueModel = new Marque();
    $vehicules = $vehiculeModel->findAllByUserId($_SESSION['user_id']);
    $marques = $marqueModel->findAll();

    // recupére pour afficher du profil utilisateur
    $userModel = new User();
    $user = $userModel->findById($_SESSION['user_id']);

    //recupere pour charge la vue pour les covoit des user
    $covoitModel = new Covoiturage();
    $covoiturages = $covoitModel->getCovoitAndRoleByUser($_SESSION['user_id']);

    // Recharge les covoiturages pour exclure ceux terminés/annulés (car le modèle les filtre)
    $covoiturages = $covoitModel->getCovoitAndRoleByUser($_SESSION['user_id']);

    $notationModel = new \App\Models\Notation();
    $notesRecues = $notationModel->getNotesRecues($_SESSION['user_id']);

    $notationModel = new \App\Models\Notation();
    $moyenneUtilisateur = $notationModel->getMoyenneParUtilisateur($_SESSION['user_id']);

    render(__DIR__ . '/../views/pages/profilUsers.php', [
      'title'        => 'Votre profil',
      'covoiturages' => $covoiturages,
      'vehicules' => $vehicules,
      'marques' => $marques,
      'notesRecues' => $notesRecues,
      'moyenneUtilisateur' => $moyenneUtilisateur,
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

  /**
   * Traite le formulaire de mise a jour des donnné utilisateur via le form dans le dashboard.
   */
  public function updateUser()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_SESSION['user_id'] ?? null;

      if (!$id) {
        $_SESSION['error']  = "Utilisateur non connecté.";
      } else {
        // Récupération et nettoyage des données
        $pseudo     = !empty($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : null;
        $nom        = htmlspecialchars($_POST['nom']);
        $prenom     = htmlspecialchars($_POST['prenom']);
        $email      = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $motdepasse = $_POST['motdepasse'];
        $photo      = $_FILES['photo'] ?? null;
        $hashedPassword = password_hash($motdepasse, PASSWORD_DEFAULT);

        if (!$pseudo || !$email || !$motdepasse) {
          $_SESSION['error']  = "Tous les champs sont obligatoires.";
        } else {
          // Traitement de la photo 
          $photoPath = null;
          if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($photo['name']);
            $uploadPath = __DIR__ . '/../../public/uploads/profils/' . $fileName;
            if (move_uploaded_file($photo['tmp_name'], $uploadPath)) {
              $photoPath = $fileName;
            }
          }

          $model = new User();
          $updated = $model->updateUser($id, $pseudo, $nom, $prenom, $email, $hashedPassword, $photoPath);

          if ($updated) {
            $_SESSION['success'] = "Profil mis à jour avec succès.";
          } else {
            $_SESSION['error']  = "Erreur lors de la mise à jour.";
          }
        }
      }
    }

    $userModel = new User();
    $user = $userModel->findById($_SESSION['user_id']);

    header('Location: ' . route('profil'));
    exit;
  }
}
