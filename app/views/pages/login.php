<!-- page de la view du login -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion a votre profiles</title>
  <link rel="stylesheet" href="/public\styles\css\main.css">
</head>

<body>
  <header>
    <?php
    include '../partials/header.php';
    ?>
  </header>
  <main>
    <?php
    include '../../form/loginPost.php';
    ?>
  </main>
  <footer>
    <?php
    include '../partials/footer.php';
    ?>
  </footer>
</body>

</html>