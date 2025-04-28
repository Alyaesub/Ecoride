<?php
//fichier et code qui fére le hashage
$password = 'password123';
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
echo $hash . PHP_EOL;
