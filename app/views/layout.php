<!-- page de code qui gére le layout qui sert a l'affichage des pages -->

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlentities($title ?? 'EcoRide') ?></title>
  <?php echo "<!-- layout chargé -->"; ?>
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