<section class="detail-covoiturage-section">

  <h1>Détails du covoiturage</h1>

  <?php if (!empty($_SESSION['success'])) : ?>
    <div class="message-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['error'])) : ?>
    <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php if (!empty($covoiturage)) : ?>
    <div class="covoiturage-infos">
      <p class="statut-covoit <?= $covoiturage['statut'] ?>"><strong>Statut :</strong> <?= ucfirst($covoiturage['statut']) ?></p>
      <p>
        <strong>Conducteur :</strong>
        <a href="<?= route('detailsProfil') . '?id=' . $covoiturage['id_utilisateur'] ?>">
          <?= htmlspecialchars($covoiturage['pseudo_conducteur']) ?> 🔍
        </a>
        <?php if (!empty($covoiturage['note_conducteur'])) : ?>
          <span class="note-conducteur"> — Moyenne : <?= $covoiturage['note_conducteur'] ?> ⭐</span>
        <?php endif; ?>
      </p>
      <p><strong>Départ :</strong> <?= htmlspecialchars($covoiturage['adresse_depart']) ?></p>
      <p><strong>Arrivée :</strong> <?= htmlspecialchars($covoiturage['adresse_arrivee']) ?></p>
      <p><strong>Date & Heure :</strong>
        <?= date('d/m/Y H:i', strtotime($covoiturage['date_depart'])) ?> →
        <?= date('H:i', strtotime($covoiturage['date_arrivee'])) ?>
      </p>
      <?php if (!empty($vehicule)) : ?>
        <p>
          <strong>Véhicule :</strong>
          <?= htmlspecialchars($vehicule['modele']) ?> -
          <?= htmlspecialchars($vehicule['immatriculation']) ?> (<?= htmlspecialchars($vehicule['nom_marque']) ?>)
        </p>
      <?php endif; ?>
      <p><strong>Places disponibles :</strong> <?= $covoiturage['places_disponibles'] ?></p>
      <p><strong>Écologique :</strong> <?= $covoiturage['est_ecologique'] ? '✅ Oui' : '❌ Non' ?></p>
      <p><strong>Animaux acceptés :</strong> <?= $covoiturage['animaux_autorises'] ? '✅ Oui' : '❌ Non' ?></p>
      <p><strong>Fumeur :</strong> <?= $covoiturage['fumeur'] ? '🚬 Oui' : '🚭 Non' ?></p>
      <p><strong>Prix :</strong> <?= number_format($covoiturage['prix_personne'], 2) ?> Crédits</p>
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

    <?php if (!isset($_SESSION['user_id'])) : ?>
      <p> Tu dois être connecté pour participer à un covoiturage.</p>
      <a href="<?= route('login') ?>" class="buttonlink actions"> Se connecter</a>
    <?php endif; ?>

    <div class="actions">
      <!-- Participer -->
      <?php if (!empty($covoiturage['peut_participer']) && (
        $covoiturage['statut'] !== 'termine' &&
        $covoiturage['statut'] !== 'annule' &&
        $covoiturage['places_disponibles'] > 0 &&
        $_SESSION['user_id'] !== $covoiturage['id_utilisateur'] &&
        $covoiturage['statut'] !== 'en_cours'
      )) : ?>
        <form action="<?= route('participeCovoiturage') ?>" method="post">
          <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
          <button type="submit" class="btn">Participer</button>
        </form>
      <?php endif; ?>

      <?php if (
        !empty($covoiturage['role_utilisateur']) &&
        ($covoiturage['role_utilisateur'] === 'passager' &&
          $covoiturage['statut'] !== 'termine' &&
          $covoiturage['statut'] !== 'en_cours' &&
          $covoiturage['statut'] !== 'annule')
      ): ?>
        <form action="<?= route('annuleParticipation') ?>" method="post">
          <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
          <button type="submit" class="btn btn-danger">Annuler ma participation</button>
        </form>
      <?php endif; ?>

      <?php if (!empty($isAuthor)) : ?>
        <div class="gestion-covoit">

          <?php if ($covoiturage['statut'] === 'actif') : ?>
            <form action="<?= route('modifierCovoiturage') ?>" method="post" style="display:inline;">
              <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
              <button type="submit" class="btn">✏️ Modifier</button>
            </form>

            <form action="<?= route('annulerCovoiturage') ?>" method="post" style="display:inline;">
              <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
              <button type="submit" class="btn">❌ Annuler</button>
            </form>
          <?php endif; ?>

          <!-- Bouton unique pour démarrer ou terminer -->
          <?php if (in_array($covoiturage['statut'], ['actif', 'en_cours'])) : ?>
            <form action="<?= route('changerStatutCovoiturage') ?>" method="post">
              <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
              <input type="hidden" name="statut_actuel" value="<?= $covoiturage['statut'] ?>">
              <button type="submit" class="btn">
                <?= $covoiturage['statut'] === 'actif' ? '🟢 Démarrer le covoiturage' : '✅ Terminer le covoiturage' ?>
              </button>
            </form>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <!-- Bouton pour les passagers une fois terminé -->
      <?php if (
        $covoiturage['statut'] === 'termine' &&
        $covoiturage['role_utilisateur'] === 'passager' &&
        empty($covoiturage['trajet_termine'])
      ) : ?>
        <form action="<?= route('terminerCovoiturage') ?>" method="post">
          <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
          <button type="submit" class="btn">✅ Confirmer la fin du trajet</button>
        </form>
      <?php elseif (!empty($covoiturage['trajet_termine'])) : ?>
        <p>✔️ Trajet confirmé</p>
      <?php endif; ?>

      <!-- bouton pour report un covoit -->
      <?php if (
        $covoiturage['statut'] === 'termine' &&
        $covoiturage['role_utilisateur'] === 'passager' &&
        $covoiturage['role_utilisateur'] === 'chauffeur' &&
        empty($covoiturage['trajet_termine'])
      ) : ?>
        <form action="" method="post">
          <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
          <button type="submit" class="btn">⚠️ signalez un probleme</button>
        </form>
      <?php endif; ?>

      <!-- Notation et Avis -->
      <?php if (
        isset($covoiturage['role_utilisateur']) &&
        $covoiturage['role_utilisateur'] === 'passager'  &&
        $covoiturage['statut'] === 'termine' &&
        empty($covoiturage['deja_note'])
      ) : ?>
        <div class="form-notation">
          <h2>Laisser une note et un commentaire</h2>
          <!-- formulaire notation -->
          <form action="<?= route('ajouterNote') ?>" method="post" onsubmit="return verifierFormulaire();">
            <input type="hidden" name="covoiturage_id" value="<?= $covoiturage['id_covoiturage'] ?>">
            <input type="hidden" name="conducteur_id" value="<?= $covoiturage['id_utilisateur'] ?>">
            <label for="note">Note (1 à 5) :</label>
            <select name="note" id="note">
              <option value="">-- Choisir --</option>
              <?php for ($i = 1; $i <= 5; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?> ⭐</option>
              <?php endfor; ?>
            </select>
          </form>
          <!-- FORMULAIRE 2 : AVIS -->
          <form action="<?= route('ajouterAvisMongo') ?>" method="post">
            <input type="hidden" name="id_utilisateur" value="<?= $covoiturage['id_utilisateur'] ?>">
            <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
            <input type="hidden" name="id_auteur" value="<?= $_SESSION['user_id'] ?>">
            <label for="commentaire">Commentaire (optionnel) :</label>
            <textarea name="commentaire" id="commentaire" rows="4" placeholder="Tu peux ajouter un avis..."></textarea>
            <button type="submit" class="btn">Envoyer</button>
          </form>
        </div>
      <?php endif; ?>
      <button class="buttonlink" onclick="history.back()">↩ Retour</button>
    </div>

  <?php else : ?>
    <p>❌ Ce covoiturage n'existe pas ou a été supprimé.</p>
  <?php endif; ?>
</section>

<script src="/js/detailsCovoit.js"></script>