<section class="main-admin">
  <h1>Dashboard Employé</h1>

  <a class="logout" href="<?= route("logout") ?>">Déconnexion</a>

  <section class="review-validation">
    <h2>Validation des avis</h2>
    <?php if (empty($avisEnAttente)): ?>
      <p>Aucun avis en attente.</p>
    <?php else: ?>
      <?php foreach ($avisEnAttente as $avis): ?>
        <div class="review">
          <p><strong>Utilisateur ciblé :</strong> <?= htmlspecialchars($avis['id_utilisateur']) ?></p>
          <p><strong>Auteur :</strong> <?= htmlspecialchars($avis['id_auteur']) ?></p>
          <p><strong>Commentaire :</strong> <?= htmlspecialchars($avis['commentaire']) ?></p>
          <p><strong>Date :</strong> <?= htmlspecialchars($avis['date']) ?></p>

          <form method="post" action="<?= route('validerAvis') ?>">
            <input type="hidden" name="id_avis" value="<?= htmlspecialchars($avis['_id']) ?>">
            <button type="submit" class="validate-btn">Valider</button>
          </form>

          <form method="post" action="<?= route('refuserAvis') ?>">
            <input type="hidden" name="id_avis" value="<?= htmlspecialchars($avis['_id']) ?>">
            <button type="submit" class="reject-btn">Refuser</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

  <section class="problematic-rides">
    <h2>Covoiturages problématiques</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Trajet</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($trajetLitige)): ?>
          <?php foreach ($trajetLitige as $litige): ?>
            <tr>
              <td><?= htmlspecialchars($litige['id_covoiturage']) ?></td>
              <td><?= htmlspecialchars($litige['adresse_depart']) ?> → <?= htmlspecialchars($litige['adresse_arrivee']) ?></td>
              <td><?= htmlspecialchars($litige['date_depart']) ?></td>
              <td>
                <a href="<?= route('detailsLitige') ?>?id=<?= $litige['id_covoiturage'] ?>">👁 Voir détails</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4">Aucun covoiturage problématique pour le moment.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
  <section class="user-management">
    <h2>Gestion des utilisateurs</h2>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($utilisateurs as $user): ?>
          <tr>
            <td><?= htmlspecialchars($user['nom']) ?></td>
            <td><?= htmlspecialchars($user['prenom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['actif'] ? 'Actif' : 'Suspendu' ?></td>
            <td>
              <form method="post" action="<?= route('toggleUser') ?>">
                <input type="hidden" name="id_utilisateur" value="<?= $user['id_utilisateur'] ?>">
                <button class="suspend-btn">
                  <?= $user['actif'] ? 'Suspendre' : 'Réactiver' ?>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="pagination">
      <?php
      $totalPagesUser = ceil($totalUtilisateur / 5);
      for ($i = 1; $i <= $totalPagesUser; $i++): ?>
        <a href="<?= route('dashboardemploye') ?>?page_user=<?= $i ?>" <?= $pageUtilisateur === $i ? 'class="active"' : '' ?>><?= $i ?></a>
      <?php endfor; ?>
    </div>
  </section>
</section>