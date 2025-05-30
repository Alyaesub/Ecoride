<?php
$title = 'Créer un profile employé';

?>
<section class="registerMain">
  <h1>Créer un profil employé</h1>
  <form class="registerForm" action="<?= route('registerEmploye') ?>" method="post">
    <label>Pseudo :</label>
    <input type="text" name="pseudo" required><br>

    <label>Nom :</label>
    <input type="text" name="nom"><br>

    <label>Prénom :</label>
    <input type="text" name="prenom"><br>

    <label>Email :</label>
    <input type="email" name="email" required><br>

    <label>Poste :</label>
    <input type="text" name="poste" required><br>

    <label>Numéro de badge :</label>
    <input type="number" name="numero_badge" required><br>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br>

    <button type="submit">Créer le profil</button>
  </form>
  <?php if (!empty($success)): ?>
    <div class="alert message-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
    <div class="message-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
</section>