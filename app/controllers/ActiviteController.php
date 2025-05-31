<?php //feuille de code qui gére les controller pour la page Activié

namespace App\Controllers;

use App\Models\User;
use App\Models\Notation;


class ActiviteController
{
  /**
   * fonction qui affiche activités si user connecter
   */
  public function showActivites()
  {
    if (!isset($_SESSION['user_id'])) {
      header("Location: /login");
      exit();
    }

    $userModel = new User();
    $user = $userModel->findById($_SESSION['user_id']);


    render(__DIR__ . '/../views/pages/activites.php', [
      'title'        => 'Activités',
      'user' => $user
    ]);
  }
}
