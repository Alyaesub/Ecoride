<section class="credit-info">
  <h2>Acheter des crédits</h2>

  <?php if (!empty($_SESSION['success'])) : ?>
    <div class="message-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['error'])) : ?>
    <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <p>
    Chez <strong>EcoRide</strong>, nous avons mis en place un système de crédits pour assurer un fonctionnement simple, équitable et sécurisé de notre plateforme.
  </p>

  <ul>
    <li>✅ <strong>2 crédits</strong> sont prélevés par covoiturage terminé, pour soutenir les frais de fonctionnement de la plateforme.</li>
    <li>✅ Les crédits sont prélevés <strong>dès qu’une place est réservée</strong> sur un trajet.</li>
    <li>✅ Le <strong>prix du covoiturage</strong> est librement fixé par le conducteur.</li>
    <li>✅ Les crédits sont <strong>automatiquement reversés au chauffeur</strong> quand tous les participants ont confirmé que le trajet est terminé.</li>
    <li>⚠️ En cas de conflit ou d’incident signalé, un <strong>employé EcoRide</strong> examine la situation avant de valider le transfert des crédits.</li>
  </ul>

  <p>
    🎯 Notre objectif est de garantir une expérience fluide, sécurisée et juste pour tous. En utilisant les crédits, vous soutenez une plateforme éthique, sans publicités ni commissions abusives. Merci pour votre confiance 🙏
  </p>
</section>

<section class="credit-form">
  <h3>Choisissez votre formule :</h3>
  <form action="<?= route('acheteCredits') ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()); ?>">
    <label for="credit_amount">Choisissez un montant :</label>
    <select name="credit_amount" id="credit_amount">
      <option value="5">5 crédits - 5€</option>
      <option value="10">10 crédits - 9€</option>
      <option value="20">20 crédits - 16€</option>
      <option value="40">40 crédits - 30€</option>
      <option value="60">60 crédits - 50€</option>
      <option value="80">80 crédits - 60€</option>
    </select>
    <button type="submit"> 💳 Payer</button>
  </form>
</section>