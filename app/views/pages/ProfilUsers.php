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


  <!-- Gestion des trajets
  <fieldset>
      <legend>Gestion des trajets</legend>

      <p>Sélectionnez votre statut :</p>
      <input type="radio" id="chauffeur" name="statut" value="chauffeur" required>
      <label for="chauffeur">Chauffeur</label><br>

      <input type="radio" id="passager" name="statut" value="passager" required>
      <label for="passager">Passager</label><br>

      <input type="radio" id="lesdeux" name="statut" value="lesdeux" required>
      <label for="lesdeux">Passager Chauffeur (les deux)</label><br><br>
    </fieldset> -->

  <!-- <label for="wallet">Wallet (solde de crédit) :</label><br>
      <input type="number" id="wallet" name="wallet" value="20" readonly><br><br> -->


  <footer>
    <?php
    include '../partials/footer.php';
    ?>
  </footer>
</body>

</html>