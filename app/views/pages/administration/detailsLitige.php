<section class="details-litige">
  <h1>Détail du litige #<?= htmlspecialchars($details['id_covoiturage']) ?></h1>

  <?php if (!empty($_SESSION['success'])) : ?>
    <div class="message-success">
      <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <h2>Trajet</h2>
  <p><strong>Départ :</strong> <?= htmlspecialchars($details['adresse_depart'] ?? '') ?></p>
  <p><strong>Arrivée :</strong> <?= htmlspecialchars($details['adresse_arrivee'] ?? '') ?></p>
  <p><strong>Date départ :</strong> <?= htmlspecialchars($details['date_depart'] ?? '') ?></p>
  <p><strong>Date arrivée :</strong> <?= htmlspecialchars($details['date_arrivee'] ?? '') ?></p>
  <p><strong>Statut :</strong> <?= htmlspecialchars($details['statut'] ?? '') ?></p>

  <h2>Conducteur</h2>
  <p><strong>Pseudo :</strong> <?= htmlspecialchars($details['chauffeur'] ?? '') ?></p>

  <h2>Passager</h2>
  <p><strong>Pseudo :</strong> <?= htmlspecialchars($details['passager'] ?? '') ?></p>

  <h2>Avis associés</h2>
  <?php if (!empty($avis)): ?>
    <ul>
      <?php foreach ($avis as $a): ?>
        <li><?= htmlspecialchars($a['commentaire']) ?> (<?= $a['date'] ?>)</li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>Aucun avis pour ce trajet.</p>
  <?php endif; ?>

  <!-- Formulaire de résolution -->
  <h2>Action de résolution</h2>
  <form method="post" action="<?= route('resoudreLitige') ?>">
    <input type="hidden" name="id_covoiturage" value="<?= htmlspecialchars($details['id_covoiturage'] ?? '') ?>">

    <label for="nouveau_statut">Nouveau statut :</label>
    <select name="nouveau_statut" id="nouveau_statut" required>
      <option value="">-- Choisir --</option>
      <option value="termine">Valider le trajet</option>
      <option value="annule">Annuler le trajet</option>
    </select>

    <button type="submit" class="btn">✅ Résoudre le litige</button>
  </form>

  <br>
  <a href="<?= route('dashboardEmploye') ?>" class="buttonlog">⬅️ Retour au dashboard</a>
</section>