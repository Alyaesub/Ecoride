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

  /**
   * fonction qui gére la connexion de l'user via le pseudo le mail et le mdp
   */
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

  /**
   * fonction qui crée un nouvel utilisateur en base de données
   */
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

  /**
   * fonction qui met a jours les data user via le formulaire
   */
  public function updateUser($id, $pseudo, $nom, $prenom, $email, $hashedPassword, $photo): bool
  {
    $fields = [
      'pseudo'     => $pseudo,
      'nom'        => $nom,
      'prenom'     => $prenom,
      'email'      => $email,
    ];
    if ($hashedPassword) {
      $fields['mot_de_passe'] = $hashedPassword;
    }
    if ($photo) {
      $fields['photo'] = 'uploads/profils/' . $photo;
    }

    $set = [];
    foreach ($fields as $key => $value) {
      $set[] = "$key = :$key";
    }

    $sql = "UPDATE utilisateur SET " . implode(', ', $set) . " WHERE id_utilisateur = :id";
    $stmt = $this->pdo->prepare($sql);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
  }

  /**
   * fonction qui va chercher dans la table user la ligne où id_utilisateur vaut l’ID passé en paramètre
   */
  public function findById(int $id): ?array
  {
    $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  /**
   * fonction qui gére la création d'employer
   */
  public function createEmploye($pseudo, $nom, $prenom, $email, $hashedPassword, $poste, $numeroBadge): bool
  {
    // Vérifie si l'email existe déjà
    $check = $this->pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = :email");
    $check->bindParam(':email', $email);
    $check->execute();
    if ($check->fetch()) {
      return false;
    }

    // Insertion avec rôle employé (id_role = 2)
    $stmt = $this->pdo->prepare("
        INSERT INTO utilisateur 
        (pseudo, nom, prenom, email, mot_de_passe, id_role, poste, numero_badge)
        VALUES 
        (:pseudo, :nom, :prenom, :email, :mot_de_passe, 2, :poste, :numero_badge)
    ");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $hashedPassword);
    $stmt->bindParam(':poste', $poste);
    $stmt->bindParam(':numero_badge', $numeroBadge);

    return $stmt->execute();
  }
}
