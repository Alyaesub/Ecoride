<?php //feuille de code qui gére les controller pour la page Activié

namespace App\Controllers;

use App\Models\User;
use App\Models\Covoiturage;


class ActiviteController
{
  /**
   * Fonction qui affiche les activités si l'utilisateur est connecté
   */
  public function showActivites()
  {
    if (!isset($_SESSION['user_id'])) {
      header("Location: /login");
      exit();
    }

    $id_utilisateur = $_SESSION['user_id'];

    $userModel = new User();
    $user = $userModel->findById($_SESSION['user_id']);

    $model = new Covoiturage();
    $historique = $model->getHistoriqueCovoiturages($id_utilisateur);

    render(__DIR__ . '/../views/pages/activites.php', [
      'title'        => 'Activités',
      'user'         => $user,
      'covoiturages' => $historique
    ]);
  }
}
