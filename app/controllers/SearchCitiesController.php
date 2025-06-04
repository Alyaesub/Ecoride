<?php
// Contrôleur qui gère les recherches de villes pour la searchbar (réponse en JSON)

namespace App\Controllers;

use App\Models\Covoiturage;

class SearchCitiesController
{
  public function searchCitiesBar()
  {
    if (!isset($_GET['q']) || trim($_GET['q']) === '') {
      echo json_encode([]);
      return;
    }

    $motCle = trim($_GET['q']);
    $model = new Covoiturage();
    $resultats = $model->searchCitiesBar($motCle);

    header('Content-Type: application/json');
    echo json_encode($resultats);
  }
}
