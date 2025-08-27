<!-- page de la view du login -->
<?php if (!empty($_SESSION['error'])): ?>
  <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="profile-container">
  <h1>Connectez vous a votre profil</h1>
  <form action="<?= route('login-user') ?>" method="post" class="formulaire" id="formId">
    <label for="email">Pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Se connecter</button>

    <div class="register-button">
      <p>Ou : </p>
      <a href="<?= route('registerUser') ?>" class="regis-btn" id="btn-register">Créer votre profil</a>
    </div>
  </form>
</div>
<script src="../../../js/ajaxHelper.js"></script>