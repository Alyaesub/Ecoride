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
    <div class="profile-picture">
      <img src="assets\mowgli-personnage-livre-jungle-10.jpg" alt="Photo de profil">
    </div>
    <form class="formulaire" id="profileForm">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required>

      <button type="submit">connetez-vous</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>

</html>