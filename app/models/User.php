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

  //fonction qui crée un nouvel utilisateur en base de données
  public function createUser(string $pseudo, string $nom, string $prenom, string $email, string $hashedPassword): bool
  {
    // Vérifie si l'email existe déjà
    $check = $this->pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = :email");
    $check->bindParam(':email', $email);
    $check->execute();
    if ($check->fetch()) {
      return false;
    }
    // Insertion de l'utilisateur
    $stmt = $this->pdo->prepare("
            INSERT INTO utilisateur (pseudo, nom, prenom, email, mot_de_passe, id_role)
            VALUES (:pseudo, :nom, :prenom, :email, :mot_de_passe, 3)
        ");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $hashedPassword);

    return $stmt->execute();
  }
  //fonction qui va chercher dans la table user la ligne où id_utilisateur vaut l’ID passé en paramètre
  public function findById(int $id): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  //fonction qui gére la connexion de l'user via le pseudo le mail et le mdp
  public function findByCredentials(string $email, string $pseudo, string $password): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email AND pseudo = :pseudo");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
      return $user;
    }
    return null;
  }
}
