<?php
$title = 'Créer votre profile';
?>
<h1>Créer votre profil</h1>
<form action="" method="post">
  <label>Pseudo :</label>
  <input type="text" name="pseudo" required><br>

  <label>Nom :</label>
  <input type="text" name="nom"><br>

  <label>Prénom :</label>
  <input type="text" name="prenom"><br>

  <label>Email :</label>
  <input type="email" name="email" required><br>

  <label>Mot de passe :</label>
  <input type="password" name="mot_de_passe" required><br>

  <label>Vous êtes :</label>
  <select name="id_role" required>
    <option value="1">Chauffeur</option>
    <option value="2">Passager</option>
  </select><br>

  <button type="submit">Créer mon profil</button>
</form>