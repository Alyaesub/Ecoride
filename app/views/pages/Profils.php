<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon profiles</title>
  <link rel="stylesheet" href="/public\styles\css\main.css">
</head>

<body>
  <header>
    <?php
    include '../partials/header.php';
    ?>
  </header>

  <div class="profile-container">
    <h1>Bienvenue sur votre profil</h1>
  </div>
  <?php
  include '../../form/login.php'; // une fois connecter la page ce reactualise sur app\models\profils.php
  ?>

  <footer>
    <?php
    include '../partials/footer.php';
    ?>
  </footer>
</body>

</html>