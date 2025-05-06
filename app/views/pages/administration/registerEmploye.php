<?php
$title = 'Créer un profile employer';

?>
<section class="registerMain">
  <h1>Créer un profil employer</h1>
  <form class="registerForm" action="<?= route('registerEmploye') ?>" method="post">
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

    <button type="submit">Créer mon profil</button>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
      <div class="message-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
  </form>
</section>