<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
  public function testCreateUser()
  {


    $userModel = new User();
    $pseudo = "testUser3";
    $nom = "Nom";
    $prenom = "Prenom";
    $email = "test3@example.com";
    $password = password_hash("secret", PASSWORD_DEFAULT);

    $result = $userModel->createUser($pseudo, $nom, $prenom, $email, $password);

    $this->assertTrue($result, "La création d’un utilisateur doit retourner true");
  }
}
