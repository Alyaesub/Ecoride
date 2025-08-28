<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\BSON\UTCDateTime;

class Avis
{
  /* private Collection $collection; */
  private ?Collection $collection = null;

  public function __construct()
  {
    try {
      $client = new Client("mongodb+srv://root:root@cluster0.qyuka7b.mongodb.net/Ecoride?retryWrites=true&w=majority");
      $this->collection = $client->Ecoride->avis;
    } catch (\Throwable $e) {
      // En cas de déconnexion MongoDB, on ne bloque pas l’affichage de la page
      $this->collection = null;

      error_log("Erreur de connexion MongoDB : " . $e->getMessage());
    }
  }

  //methode qui ajoute un comm en bdd
  public function ajouterCommentaire(array $data): string
  {

    if ($this->collection === null) {
      error_log("Impossible d'ajouter un avis : MongoDB indisponible.");
      return '';
    }

    try {
      $result = $this->collection->insertOne([
        'commentaire' => trim($data['commentaire']),
        'date' => new UTCDateTime(),
        'statut' => 'en_attente',
        'id_utilisateur' => intval($data['id_utilisateur']),
        'id_auteur' => intval($data['id_auteur']),
        'id_covoiturage' => intval($data['id_covoiturage']),
      ]);
      return (string) $result->getInsertedId();
    } catch (\Throwable $e) {
      error_log("Erreur lors de l'ajout d'un avis : " . $e->getMessage());
      return '';
    }
  }

  //methode qui recupére les avis reçus
  public function getAvisReçus(int $id_utilisateur): array
  {
    // Si MongoDB est indisponible, retourne un tableau vide
    if ($this->collection === null) {
      return [];
    }
    try {
      $cursor = $this->collection->find([
        'id_utilisateur' => $id_utilisateur,
        'statut' => ['$in' => ['validé']]
      ]);

      $avisReçus = [];
      foreach ($cursor as $doc) {
        $avisReçus[] = [
          'commentaire' => $doc['commentaire'] ?? '',
          'date' => $doc['date']?->toDateTime()->format('d/m/Y H:i'),
        ];
      }
      return $avisReçus;
    } catch (\Throwable $e) {
      error_log("Erreur lors de la récupération des avis : " . $e->getMessage());
      return []; // en cas d'erreur pendant la requête
    }
  }

  //methode qui recupere les avis donner
  public function getAvisDonnes(int $auteur_id): array
  {
    if ($this->collection === null) {
      return [];
    }
    try {
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
    } catch (\Throwable $e) {
      error_log("Erreur lors de la récupération des avis donnés : " . $e->getMessage());
      return [];
    }
  }

  // Méthode pour récupérer tous les avis en attente
  public function getAvisEnAttente(): array
  {
    if ($this->collection === null) return [];
    /**
     * utilisation de cursor pour parse les avis sans tous les chargé (en stream)
     */
    try {
      $cursor = $this->collection->find(['statut' => 'en_attente']);

      $avisEnAttente = [];
      foreach ($cursor as $doc) {
        $avisEnAttente[] = [
          '_id' => (string) $doc['_id'],
          'commentaire' => $doc['commentaire'] ?? '',
          'id_utilisateur' => $doc['id_utilisateur'] ?? '',
          'id_auteur' => $doc['id_auteur'] ?? '',
          'id_covoiturage' => $doc['id_covoiturage'] ?? '',
          'date' => $doc['date']?->toDateTime()->format('d/m/Y H:i') ?? '',
        ];
      }
      return $avisEnAttente;
    } catch (\Throwable $e) {
      error_log("Erreur récupération avis : " . $e->getMessage());
      return [];
    }
  }
  //methode pour changer le statu des commentaires
  public function changerStatut(string $id, string $statut): bool
  {
    if ($this->collection === null) return false;

    try {
      $this->collection->updateOne(
        ['_id' => new \MongoDB\BSON\ObjectId($id)],
        ['$set' => ['statut' => $statut]]
      );
      return true;
    } catch (\Throwable $e) {
      error_log("Erreur maj avis : " . $e->getMessage());
      return false;
    }
  }
}
