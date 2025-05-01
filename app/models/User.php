<?php
//class qui gére la connexion de l'user a la bdd
namespace App\Models;

use App\Models\ConnexionDb;
use PDO;
// permet de récupérer les données de la base de données et de créer des objets User  
class User
{
  private PDO $pdo;
  public function __construct()
  {
    // Connexion à la base de données via le modèle ConnexionDb
    $this->pdo = ConnexionDb::getPdo();
  }
  //fonction qui va chercher dans la table user la ligne où id_utilisateur vaut l’ID passé en paramètre
  public function findById(int $id): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id_utilisateur = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  //fonction qui gére la connexion de l'user via le pseudo le mail et le mdp
  public function findByCredentials(string $email, string $pseudo, string $password): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email AND pseudo = :pseudo");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }

    return null;
  }
}
