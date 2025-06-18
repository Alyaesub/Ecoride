  <?php if (!empty($_SESSION['success'])) : ?>
    <div class="message-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['error'])) : ?>
    <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <section class="contact-container">
    <h1>Contactez-nous</h1>
    <form action="<?= route('ContactMailEcoride') ?>" method="post" class="contact-form">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message :</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Envoyer</button>
    </form>
  </section>