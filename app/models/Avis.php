<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\BSON\UTCDateTime;

class Avis
{
  private Collection $collection;

  public function __construct()
  {
    $client = new Client("mongodb+srv://user:mdp@cluster0.qyuka7b.mongodb.net/Ecoride?retryWrites=true&w=majority");
    $this->collection = $client->Ecoride->avis;
  }

  //methode qui ajoute un comm en bdd
  public function ajouterCommentaire(array $data): string
  {
    $result = $this->collection->insertOne([
      'commentaire' => trim($data['commentaire']),
      'date' => new UTCDateTime(),
      'statut' => 'en_attente', // pour modération plus tard
      'id_utilisateur' => intval($data['id_utilisateur']), //cible du comentaire
      'id_auteur' => intval($data['id_auteur']), // auteur du commentaire
      'id_covoiturage' => intval($data['id_covoiturage']),
    ]);

    return (string) $result->getInsertedId();
  }

  //methode qui recupére les avis reçus
  public function getAvisReçus(int $id_utilisateur): array
  {
    $cursor = $this->collection->find([
      'id_utilisateur' => $id_utilisateur,
      'statut' => ['$in' => ['validé', 'en_attente']] //'validé' a mettre apres avoir fais la logique des admin
    ]);
    $avisReçus = [];
    foreach ($cursor as $doc) {
      $avisReçus[] = [
        'commentaire' => $doc['commentaire'] ?? '',
        'date' => $doc['date']?->toDateTime()->format('d/m/Y H:i'),
      ];
    }
    return $avisReçus;
  }

  //methode qui recupere les avis donner
  public function getAvisDonnes(int $auteur_id): array
  {
    $cursor = $this->collection->find([
      'id_auteur' => $auteur_id
    ]);
    $avisList = [];
    foreach ($cursor as $doc) {
      $avisList[] = [
        'commentaire' => $doc['commentaire'] ?? '',
        'date' => $doc['date']?->toDateTime()->format('d/m/Y H:i'),
      ];
    }
    return $avisList;
  }
}
