<!-- contenue de l'onglet Paramètres -->
<div id="parametres" class="tab-content">
  <div class="section">
    <div id="displayParametres" class="display-box">
      <!-- Affichage des paramètres enregistrés -->
      <h2>Vos paramètres</h2>
      <ul>
        <li><strong>Langue :</strong> <?= htmlspecialchars($langue) ?></li>
        <li><strong>Notifications :</strong> <?= htmlspecialchars($notifications) ?></li>
      </ul>
    </div>
    <h2>Modifier vos parametres</h2>
    <form id="formParametres" action="<?= route("parametres") ?>" method="post">
      <label for="langue">Langue :</label>
      <select id="langue" name="langue">
        <option value="fr">Français</option>
        <option value="en">Anglais</option>
        <option value="es">Espagnol</option>
      </select>

      <label for="notifications">Notifications :</label>
      <input type="checkbox" id="notifications" name="notifications">

      <button type="submit">Enregistrer les modifications</button>
    </form>
    <?php if (!empty($success)) : ?>
      <div class="success-message"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
  </div>
</div>


<!-- ligne pour le dashboard
<button class="tab-link" data-tab="parametres">Paramètres</button> -->


<?php

/* namespace App\Controllers; */

use App\Models\Parametre;
use App\Models\User;

class ParametreController
{
  public function gererParametres()
  {
    // Vérification de la session utilisateur
    // je récupère l'identifiant de l'utilisateur connecté depuis la session
    $id_utilisateur = $_SESSION['user_id'] ?? null;

    // Si l'utilisateur n'est pas connecté, on affiche un message d'erreur et on arrête l'exécution
    if (!$id_utilisateur) {
      $error = "Utilisateur non connecté.";
      return;
    }

    /*  $model = new Parametre(); */

    // Traitement du formulaire envoyé en méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupération des données envoyées via le formulaire
      // récupère la langue choisie ou on met 'fr' par défaut
      $langue = $_POST['langue'] ?? 'fr';
      //vérifie si la case notifications est cochée, sinon on considère que c'est 'non'
      $notifications = isset($_POST['notifications']) ? 'oui' : 'non';

      // Mise à jour des paramètres dans la base de données via le modèle
      /* $model->updateParametre($id_utilisateur, 'langue', $langue);
      $model->updateParametre($id_utilisateur, 'notifications', $notifications);
 */
      // stocke un message de succès dans la session pour l'afficher après redirection
      $_SESSION['success'] = "Paramètres mis à jour avec succès.";

      // Redirection vers la page profil pour éviter le rechargement du formulaire
      header('Location: ' . route('profil'));
      exit;
    }

    // Récupération des paramètres existants pour l'utilisateur connecté
    /*  $parametres = $model->getParametresByUserId($id_utilisateur);
 */
    // Récupération des informations utilisateur si besoin
    $userModel = new User();
    $user = $userModel->findById($id_utilisateur);

    // Conversion des paramètres en tableau associatif pour un accès plus simple
    /*    $parametres_assoc = [];
    foreach ($parametres as $param) {
      $parametres_assoc[$param['propriete']] = $param['valeur'];
    } */

    // Traduction directe des codes langue en libellés lisibles
    $traduction_langue = [
      'fr' => 'Français',
      'en' => 'Anglais',
      'es' => 'Espagnol'
    ];

    // Récupération de la langue affichée, avec gestion des cas non définis
    $langue_code = $parametres_assoc['langue'] ?? 'non défini';
    $langue_affichee = $traduction_langue[$langue_code] ?? ucfirst($langue_code);
    // Traduction de l'état des notifications pour affichage
    $notifications = ($parametres_assoc['notifications'] ?? 'non') === 'oui' ? 'Activées' : 'Désactivées';

    // Passage des données à la vue pour affichage
    /*     render(__DIR__ . '/../views/pages/profilUsers.php', [
      'title'       => 'Modifier vos parametres',
      'parametres'  => $parametres,
      'user'        => $user,
      'success'     => $_SESSION['success'] ?? null,
      'error'   => $error   ?? null,
      'langue'       => $langue_affichee,
      'notifications' => $notifications
    ]); */
  }
}
////////////////////////
///////////////////// MODEL POUR LES PARAMETRES

/* namespace App\Models; */
/* 
use App\Models\ConnexionDb;
use PDO;


class Parametre
{
  private PDO $pdo;
  public function __construct()
  { */
/*     // Connexion à la base de données via le modèle ConnexionDb
    $this->pdo = ConnexionDb::getPdo();
  } */

/**
 * function qui recupere les parametres de l'utilisateur
 */
/*   public function getParametresByUserId($id_utilisateur)
  {
    $stmt = $this->pdo->prepare("SELECT propriete, valeur FROM parametre WHERE id_utilisateur = ?");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } */

/**
 * function qui met a jours les parametres de l'utilisateur
 */
/*   public function updateParametre($id_utilisateur, $propriete, $valeur)
  {
    // Vérifie si le paramètre existe déjà
    $stmt = $this->pdo->prepare("SELECT id_parametre FROM parametre WHERE id_utilisateur = ? AND propriete = ?");
    $stmt->execute([$id_utilisateur, $propriete]);
    $existing = $stmt->fetch();

    if ($existing) {
      $stmt = $this->pdo->prepare("UPDATE parametre SET valeur = ? WHERE id_utilisateur = ? AND propriete = ?");
      $stmt->execute([$valeur, $id_utilisateur, $propriete]);
    } else {
      $stmt = $this->pdo->prepare("INSERT INTO parametre (id_utilisateur, propriete, valeur) VALUES (?, ?, ?)");
      $stmt->execute([$id_utilisateur, $propriete, $valeur]);
    }
  }
} */


////////: rpoute de l'index pour les parametres

/*   case 'parametres':
    $controller = new ParametreController();
    $controller->gererParametres();
    break; */

///////////////////// code du usercontroller

// Récupérer les infos de l’utilisateur pour afficher les parametres
/*   $model = new Parametre();
    $parametres = $model->getParametresByUserId($_SESSION['user_id'] ?? 0); */

// Préparation propre pour affichage
/* $parametres_assoc = [];
    foreach ($parametres as $param) {
      $parametres_assoc[$param['propriete']] = $param['valeur'];
    } */

$traduction_langue = [
  'fr' => 'Français',
  'en' => 'Anglais',
  'es' => 'Espagnol'
];
$langue_code = $parametres_assoc['langue'] ?? 'non défini';
$langue_affichee = $traduction_langue[$langue_code] ?? ucfirst($langue_code);
$notifications = ($parametres_assoc['notifications'] ?? 'non') === 'oui' ? 'Activées' : 'Désactivées';



     /* 'parametres'   => $parametres, */
     /*  'langue'       => $langue_affichee,
      'notifications' => $notifications, */