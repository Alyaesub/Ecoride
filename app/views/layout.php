<!-- page de code qui gére le layout qui sert a l'affichage des pages -->

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlentities($title ?? 'EcoRide') ?></title>
  <?php echo "<!-- layout chargé -->"; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Geologica:wght@100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/styles/css/main.css">
</head>


<body>
  <?php include __DIR__ . '/partials/header.php'; ?>

  <div class="page-container">
    <main class="main-content" id="">
      <?= $pageContent ?? '<p>Pas de contenu disponible</p>' ?>
    </main>

    <footer class="footer">
      <?php include __DIR__ . '/partials/footer.php'; ?>
    </footer>
  </div>
</body>

</html>