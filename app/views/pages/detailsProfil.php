<div class="profil-container">
  <h2>Profil du conducteur</h2>

  <?php if ($utilisateur) : ?>
    <div class="profil-details">
      <img src="/public/<?= htmlspecialchars($utilisateur['photo'] ?? 'assets/img/default-user.png') ?>" alt="Photo de profil" class="profil-photo">
      <p><strong>Nom :</strong> <?= htmlspecialchars($utilisateur['nom']) ?></p>
      <p><strong>Prénom :</strong> <?= htmlspecialchars($utilisateur['prenom']) ?></p>

      <?php if ($moyenne !== null) : ?>
        <p><strong>Note moyenne :</strong> <?= number_format($moyenne, 2) ?> ⭐</p>
      <?php else : ?>
        <p>Aucune note pour le moment.</p>
      <?php endif; ?>
    </div>

    <div class="profil-avis">
      <h2>Avis reçus</h2>
      <?php if (!empty($avis)) : ?>
        <ul>
          <?php foreach ($avis as $a) : ?>
            <li>
              <p>"<?= htmlspecialchars($a['commentaire']) ?>"</p>
              <small>— laissé le <?= date('d/m/Y', strtotime($a['date'])) ?></small>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else : ?>
        <p>Aucun avis pour ce conducteur.</p>
      <?php endif; ?>
    </div>
  <?php else : ?>
    <p>Utilisateur introuvable.</p>
  <?php endif; ?>

  <button class="buttonlink" onclick="history.back()">↩ Retour</button>


</div>