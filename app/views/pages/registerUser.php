  <?php if (!empty($success)): ?>
    <div class="alert message-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
    <div class="message-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <section class="registerMain">
    <h1>Créer votre profil</h1>
    <form class="registerForm" action="<?= route('registerUser') ?>" method="post" id="registerForm">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()); ?>">

      <label>Pseudo :</label>
      <input type="text" name="pseudo" required><br>

      <label>Nom :</label>
      <input type="text" name="nom" required><br>

      <label>Prénom :</label>
      <input type="text" name="prenom" required><br>

      <label>Email :</label>
      <input type="email" name="email" required><br>

      <label>Mot de passe :</label>
      <input type="password" name="mot_de_passe" required><br>
      <label for="motdepasse">Répetez votre mot de passe :</label>
      <input type="password" id="motdepasse" name="motdepasse_confirm" required>

      <button type="submit">Créer mon profil</button>
    </form>
  </section>