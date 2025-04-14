<!-- pagge view du formulaire de covoiturage dans voyage -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Covoiturage</title>
    <link rel="stylesheet" href="/public\styles\css\main.css">
</head>

<body>

    <?php
    include '../partials/header.php';
    ?>

    <main>
        <?php
        include '../../form/covoitForm.php';
        ?>
    </main>

    <?php
    include '../partials/footer.php';
    ?>

</body>

</html>