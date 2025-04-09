<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil EcoRide</title>
    <link rel="stylesheet" href="/public/styles/css/main.css">
</head>

<body>
    <main>
        <header>
            <?php
            require_once 'app/views/partials/header.php';
            ?>
        </header>

        <body>
            <?php
            require_once 'app/views/partials/home.php';
            ?>
        </body>

        <footer>
            <?php
            require_once 'app/views/partials/footer.php';
            ?>
        </footer>
    </main>
</body>

</html>