<!-- page de la view du login -->
<?php $title = 'Connexion à votre profil';
session_start();
// Si l'utilisateur est déjà connecté, rediriger vers le profil
if (isset($_SESSION['user'])) {
  header('Location: /views/profilUsers.php');
  exit();
}

?>

<div class="profile-container">
  <h1>Connectez vous a votre profil</h1>
  <?php if (isset($_GET['error'])): ?>
    <p style="color: red;">Identifiants incorrects, merci de réessayer.</p>
  <?php endif; ?>
  <form action="<?= route('login-user') ?>" method="post" class="formulaire" id="profileForm">
    <label for="email">Pseudo :</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Se connecter</button>

    <div class="register-button">
      <p>Ou : </p>
      <a href="<?= route('register') ?>" class="regis-btn" id="btn-register">Créer votre profil</a>
    </div>
  </form>
</div>