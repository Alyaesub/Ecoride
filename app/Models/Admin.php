<?php

namespace App\Models;

use PDO;

class Admin
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = ConnexionDb::getPdo();
  }

  public function getEmployesPaginated($limit, $offset)
  {
    $sql = "SELECT id_utilisateur, nom, prenom, email, actif FROM utilisateur WHERE id_role = 2 LIMIT :limit OFFSET :offset";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  //methode qui recup les employer en bdd
  public function countEmployes()
  {
    $sql = "SELECT COUNT(*) as total FROM utilisateur WHERE id_role = 2";
    return $this->pdo->query($sql)->fetch()['total'];
  }

  //methode qui recupere les user pour les afficher dans le dashboard admin
  public function getUsersPaginated($limit, $offset)
  {
    $sql = "SELECT id_utilisateur, nom, prenom, email, actif FROM utilisateur WHERE id_role = 3 LIMIT :limit OFFSET :offset";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function countUsers()
  {
    $sql = "SELECT COUNT(*) as total FROM utilisateur WHERE id_role = 3";
    return $this->pdo->query($sql)->fetch()['total'];
  }

  //methode qui change le statut des user (actif)
  public function toggleUser($id)
  {
    $sql = "UPDATE utilisateur SET actif = NOT actif WHERE id_utilisateur = :id AND id_role = 3";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  //methode qui change le statut d'un copt employer
  public function toggleActif($id)
  {
    $sql = "UPDATE utilisateur SET actif = NOT actif WHERE id_utilisateur = :id AND id_role = 2";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  //methode qui recup les covoit par jour pour les stats
  public function getCovoituragesParJour()
  {
    $sql = "SELECT DATE(date_depart) as jour, COUNT(*) as total
          FROM covoiturage
          WHERE date_depart >= CURDATE() - INTERVAL 6 DAY
            AND date_depart <= CURDATE() + INTERVAL 1 DAY
          GROUP BY DATE(date_depart)
          ORDER BY jour ASC";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll();
  }

  //methode qui recupe les credit gagner par jour pour les stats
  public function getCreditsParJour()
  {
    $sql = "SELECT DATE(date_transaction) AS jour, SUM(montant) AS total
    FROM transaction
    WHERE statut = 'validee'
      AND date_transaction >= CURDATE() - INTERVAL 7 DAY
    GROUP BY jour
    ORDER BY jour ASC
  ";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll();
  }
}
