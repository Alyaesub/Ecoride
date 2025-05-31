<section class="detail-covoiturage-section">

  <h1>Détails du covoiturage</h1>

  <?php if (!empty($covoiturage)) : ?>
    <div class="covoiturage-infos">
      <p><strong>Statut :</strong> <?= ucfirst($covoiturage['statut']) ?></p>
      <p><strong>Départ :</strong> <?= htmlspecialchars($covoiturage['adresse_depart']) ?></p>
      <p><strong>Arrivée :</strong> <?= htmlspecialchars($covoiturage['adresse_arrivee']) ?></p>
      <p><strong>Date & Heure :</strong>
        <?= date('d/m/Y H:i', strtotime($covoiturage['date_depart'])) ?> →
        <?= date('H:i', strtotime($covoiturage['date_arrivee'])) ?>
      </p>
      <p><strong>Conducteur :</strong> <?= htmlspecialchars($covoiturage['pseudo_conducteur']) ?>
        <?php if (!empty($notation['note_conducteur'])) : ?>
          <span class="note-conducteur">— Moyenne : <?= $covoiturage['note_conducteur'] ?> ⭐</span>
        <?php endif; ?>
      </p>
      <p><strong>Places disponibles :</strong> <?= $covoiturage['places_disponibles'] ?></p>
      <p><strong>Écologique :</strong> <?= $covoiturage['est_ecologique'] ? '✅ Oui' : '❌ Non' ?></p>
      <p><strong>Animaux acceptés :</strong> <?= $covoiturage['animaux_autorises'] ? '✅ Oui' : '❌ Non' ?></p>
      <p><strong>Fumeur :</strong> <?= $covoiturage['fumeur'] ? '🚬 Oui' : '🚭 Non' ?></p>
      <p><strong>Prix :</strong> <?= number_format($covoiturage['prix_personne'], 2) ?> €</p>
    </div>

    <?php if (!empty($passagers)) : ?>
      <div class="passagers-liste">
        <h2>Passagers inscrits</h2>
        <ul>
          <?php foreach ($passagers as $passager) : ?>
            <li><?= htmlspecialchars($passager['pseudo']) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="actions">
      <!-- Participer -->
      <?php if (!empty($covoiturage['peut_participer'])) : ?>
        <form action="<?= route('participer-covoiturage') ?>" method="post">
          <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
          <button type="submit" class="btn">Participer</button>
        </form>
      <?php endif; ?>

      <?php if (!empty($isAuthor)) : ?>
        <div class="gestion-covoit">
          <form action="<?= route('modifierCovoiturage') ?>" method="post" style="display:inline;">
            <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
            <button type="submit" class="btn">✏️ Modifier</button>
          </form>

          <form action="<?= route('annulerCovoiturage') ?>" method="post" style="display:inline;">
            <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
            <button type="submit" class="btn">❌ Annuler</button>
          </form>

          <form action="<?= route('terminerCovoiturage') ?>" method="post" style="display:inline;">
            <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
            <button type="submit" class="btn">✅ Terminer</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Noter -->
      <?php if (!empty($covoiturage['est_termine']) && empty($covoiturage['deja_note'])) : ?>
        <div class="form-notation">
          <h2>Laisser une note et un commentaire</h2>

          <form action="<?= route('ajouterNote') ?>" method="post" onsubmit="return verifierFormulaire();">
            <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
            <input type="hidden" name="conducteur_id" value="<?= $covoiturage['id_utilisateur'] ?>">

            <label for="note">Note (1 à 5) :</label>
            <select name="note" id="note">
              <option value="">-- Choisir --</option>
              <?php for ($i = 1; $i <= 5; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?> ⭐</option>
              <?php endfor; ?>
            </select>

            <label for="commentaire">Commentaire (optionnel) :</label>
            <textarea name="commentaire" id="commentaire" rows="4" placeholder="Tu peux ajouter un avis..."></textarea>

            <button type="submit" class="btn">Envoyer</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Retour -->
      <button>
        <a href="javascript:history.back()" class="btn">↩ Retour</a>
      </button>
    </div>

  <?php else : ?>
    <p>❌ Ce covoiturage n'existe pas ou a été supprimé.</p>
  <?php endif; ?>
</section>

<script src="/js/detailsCovoit.js"></script>