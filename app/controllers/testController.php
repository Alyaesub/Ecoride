<?php

namespace App\Controllers;

class TestController
{
  public function __construct()
  {
    echo "✅ TestController chargé automatiquement !<br>";
  }

  public function hello()
  {
    echo "Hello depuis TestController ! 🚗<br>";
  }
}
