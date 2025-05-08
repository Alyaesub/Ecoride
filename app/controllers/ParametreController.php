<?php

namespace App\Controllers;

use App\Models\ParametreModel;
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

    $model = new ParametreModel();

    // Traitement du formulaire envoyé en méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupération des données envoyées via le formulaire
      // récupère la langue choisie ou on met 'fr' par défaut
      $langue = $_POST['langue'] ?? 'fr';
      //vérifie si la case notifications est cochée, sinon on considère que c'est 'non'
      $notifications = isset($_POST['notifications']) ? 'oui' : 'non';

      // Mise à jour des paramètres dans la base de données via le modèle
      $model->updateParametre($id_utilisateur, 'langue', $langue);
      $model->updateParametre($id_utilisateur, 'notifications', $notifications);

      // stocke un message de succès dans la session pour l'afficher après redirection
      $_SESSION['success'] = "Paramètres mis à jour avec succès.";

      // Redirection vers la page profil pour éviter le rechargement du formulaire
      header('Location: ' . route('profil'));
      exit;
    }

    // Récupération des paramètres existants pour l'utilisateur connecté
    $parametres = $model->getParametresByUserId($id_utilisateur);

    // Récupération des informations utilisateur si besoin
    $userModel = new User();
    $user = $userModel->findById($id_utilisateur);

    // Conversion des paramètres en tableau associatif pour un accès plus simple
    $parametres_assoc = [];
    foreach ($parametres as $param) {
      $parametres_assoc[$param['propriete']] = $param['valeur'];
    }

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
    render(__DIR__ . '/../views/pages/profilUsers.php', [
      'title'       => 'Modifier vos parametres',
      'parametres'  => $parametres,
      'user'        => $user,
      'success'     => $_SESSION['success'] ?? null,
      'error'   => $error   ?? null,
      'langue'       => $langue_affichee,
      'notifications' => $notifications
    ]);
  }
}
