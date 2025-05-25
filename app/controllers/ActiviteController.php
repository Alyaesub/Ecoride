<?php //feuille de code qui gére les controller pour la page Activié

namespace App\Controllers;

use App\Models\User;
use App\Models\ConnexionDb;
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

  /**
   * function Controller qui ajoute une notes
   */
  public function ajouterNote()
  {

    $id_auteur = $_SESSION['user_id'];
    $id_conducteur = $_POST['conducteur_id'] ?? null;
    $id_covoiturage = $_POST['covoiturage_id'] ?? null;
    $note = $_POST['note'] ?? null;

    if ($id_conducteur && $id_covoiturage && $note >= 1 && $note <= 5) {
      $notation = new Notation();
      $notation->ajouter($id_conducteur, $id_auteur, $id_covoiturage, $note);
    }

    header('Location: /activite');
    exit();
  }
}
