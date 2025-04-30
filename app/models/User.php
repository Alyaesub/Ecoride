<?php
//class qui gére la connexion de l'usera la bdd
namespace App\Model;

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
