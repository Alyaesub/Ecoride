<section class="main-admin">
  <a class="logout" href="<?= route("logout") ?>">Déconnexion</a>

  <section class="sections-stats">
    <section class="stats">
      <h2>Statistiques :</h2>
      <div class="stat-item">
        <canvas id="covoitChart" width="400" height="200"></canvas>
      </div>
      <div class="stat-item">
        <canvas id="creditChart" width="400" height="200"></canvas>
      </div>
    </section>
  </section>

  <section class="employee-management">
    <h2>Gestion des employés</h2>
    <div class="register-button">
      <a href="<?= route('registerEmploye') ?>" class="regis-btn" id="btn-register">Créer un profil employés</a>
    </div>
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

      </tbody>
      <?php foreach ($employes as $emp): ?>
        <tr>
          <td><?= htmlspecialchars($emp['nom']) ?></td>
          <td><?= htmlspecialchars($emp['prenom']) ?></td>
          <td><?= htmlspecialchars($emp['email']) ?></td>
          <td><?= $emp['actif'] ? 'Actif' : 'Suspendu' ?></td>
          <td>
            <form action="<?= route('toggleEmploye') ?>" method="post">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()); ?>">
              <input type="hidden" name="id_utilisateur" value="<?= $emp['id_utilisateur'] ?>">
              <button class="suspend-btn"><?= $emp['actif'] ? 'Suspendre' : 'Réactiver' ?></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <div class="pagination">
      <?php
      $totalPagesEmp = ceil($totalEmployes / 5);
      for ($i = 1; $i <= $totalPagesEmp; $i++): ?>
        <a href="<?= route('dashboardAdmin') ?>?page_emp=<?= $i ?>" <?= $pageEmployes === $i ? 'class="active"' : '' ?>><?= $i ?></a>
      <?php endfor; ?>
    </div>
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
              <form method="post" action="<?= route('AdminToggleUser') ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()); ?>">
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
        <a href="<?= route('dashboardAdmin') ?>?page_user=<?= $i ?>" <?= $pageUtilisateur === $i ? 'class="active"' : '' ?>><?= $i ?></a>
      <?php endfor; ?>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const statsLabelsCovoit = <?= json_encode(array_column($statsCovoiturages, 'jour')) ?>;
    const statsDataCovoit = <?= json_encode(array_map('intval', array_column($statsCovoiturages, 'total'))) ?>;
    const statsLabelsCredits = <?= json_encode(array_column($statsCredits, 'jour')) ?>;
    const statsDataCredits = <?= json_encode(array_map('intval', array_column($statsCredits, 'total'))) ?>;
  </script>
  <script src="/js/chartStats.js"></script>
</section>