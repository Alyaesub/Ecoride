<?php

use PHPUnit\Framework\TestCase;
use App\Models\ConnexionDb;

class ConnexionDbTest extends TestCase
{
  public function testConnexionDbRetourneUnPDO()
  {
    $pdo = ConnexionDb::getPdo();
    $this->assertInstanceOf(PDO::class, $pdo, "La connexion doit retourner une instance PDO");
  }
}
