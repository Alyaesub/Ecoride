<section class="main-admin">
  <h1>Dashboard Administrateur</h1>

  <a class="logout" href="<?= route("logout") ?>">Déconnexion</a>

  <section class="sections-stats">
    <section class="stats">
      <h2>Statistiques :</h2>
      <div class="stat-item">
        <p>Covoiturages aujourd'hui :</p>
        <span id="rides-today">12</span>
      </div>
      <div class="stat-item">
        <p>Crédits générés aujourd'hui :</p>
        <span id="credits-today">240</span>
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
              <input type="hidden" name="id_utilisateur" value="<?= $emp['id_utilisateur'] ?>">
              <button class="suspend-btn"><?= $emp['actif'] ? 'Suspendre' : 'Réactiver' ?></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <!--      <tbody>
        <tr>
          <td>Durand</td>
          <td>Emma</td>
          <td>emma.durand@ecoride.com</td>
          <td>Actif</td>
          <td><button class="suspend-btn">Suspendre</button></td>
        </tr>
        <tr>
          <td>Martin</td>
          <td>Lucas</td>
          <td>lucas.martin@ecoride.com</td>
          <td>Actif</td>
          <td><button class="suspend-btn">Suspendre</button></td>
        </tr>
      </tbody> -->
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
        <tr>
          <td>Lemoine</td>
          <td>Sophie</td>
          <td>sophie.lemoine@mail.com</td>
          <td>Actif</td>
          <td><button class="suspend-btn">Suspendre</button></td>
        </tr>
        <tr>
          <td>Bernard</td>
          <td>Thomas</td>
          <td>thomas.bernard@mail.com</td>
          <td>Actif</td>
          <td><button class="suspend-btn">Suspendre</button></td>
        </tr>
      </tbody>
    </table>
  </section>
</section>