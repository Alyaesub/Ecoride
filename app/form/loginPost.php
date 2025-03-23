<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Utilisateur</title>
  <link rel="stylesheet" href="styles\css\main.css">
</head>

<body>
  <div class="profile-container">
    <h1>Connectez vous a votre profil</h1>
    <?php if (isset($_GET['error'])): ?>
      <p style="color: red;">Identifiants incorrects, merci de réessayer.</p>
    <?php endif; ?>
    <form action="/app/controllers/traitement.php" method="post" class="formulaire" id="profileForm">
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" required>
      <label for="password">Mot de passe :</label>
      <input type="password" name="password" id="password" required>
      <button type="submit">Se connecter</button>

      <div class="register-button">
        <p>Ou créez vous un profil : </p>
        <a href="">
          <button type="button">Créer votre profil</button>
        </a>
      </div>
    </form>
  </div>
</body>

</html>