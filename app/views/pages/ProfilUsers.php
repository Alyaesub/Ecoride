<div class="dashboard-container">
  <h1>Bienvenue, <?= htmlspecialchars($user['pseudo']) ?> !</h1>
  <?php if (!empty($_SESSION['success'])) : ?>

    <div class="message-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
  <?php if (!empty($_SESSION['error'])) : ?>
    <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <div class="profil-actions">
    <button class="logout-button">
      <a href="<?= route("logout") ?>" class="logout-link">Se déconnecter</a>
    </button>
    <button class="creditsBtn">
      <a href="<?= route("achatCredits") ?>" class="creditsBtn-link">Acheter vos crédits</a>
    </button>
    <?php if (isset($_SESSION['user'])): ?>
      <?php if ($_SESSION['user']['role'] === 1): ?>
        <a href="index.php?page=dashboardAdmin" class="admin-return-link">↩ Retour au Dashboard Admin</a>
      <?php elseif ($_SESSION['user']['role'] === 2): ?>
        <a href="index.php?page=dashboardEmploye" class="admin-return-link">↩ Retour au Dashboard Employé</a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <!-- Navigation par onglets -->
  <div class="tabs">
    <button class="tab-link active" data-tab="info">Info Utilisateur</button>
    <button class="tab-link" data-tab="vehicule">Véhicule</button>
    <button class="tab-link" data-tab="covoiturage">Covoiturage</button>
    <button class="tab-link" data-tab="gestionCovoiturage">Gérer Covoiturages</button>
    <button class="tab-link" data-tab="avis">Avis</button>
  </div>

  <!-- Contenu de l'onglet Info Utilisateur -->
  <div id="info" class="tab-content active">
    <div class="section" id="info-personnelle">
      <div id="displayInfo" class="display-box">
        <!-- Affichage des informations personnelles enregistrées -->
        <h2>Vos données enregistrées :</h2>
        <div class="photo-profil">
          <img class="pp" src="/public/<?= htmlspecialchars($user['photo'] ?? '') ?>" alt="photo de profil">
        </div>
        <ul>
          <li><strong>Pseudo :</strong><?= htmlspecialchars($user['pseudo']) ?></li>
          <li><strong>Nom :</strong><?= htmlspecialchars($user['nom']) ?></li>
          <li><strong>Prénom :</strong><?= htmlspecialchars($user['prenom']) ?></li>
          <li><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></li>
          <li><strong>Mot de passe :</strong>*******</li>
          <li><strong>Vos crédits :</strong><?= htmlspecialchars($user['credits']) ?></li>
        </ul>
      </div>
      <h2>Mettez a jour vos donées personnelle</h2>
      <form id="formInfo" class="registerForm" action="<?= route('updateUser') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_role" value="3">

        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" require>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" require>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" require>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" require>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" require>

        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo">

        <button type="submit">Mettre à jour votre profile</button>
      </form>
    </div>
  </div>

  <!-- Contenu de l'onglet Véhicule -->
  <div id="vehicule" class="tab-content">
    <div class="section">
      <div id="displayVehicule" class="display-box">
        <!-- Affichage des informations véhicule enregistrées -->
        <!-- Liste des véhicules -->
        <?php if (!empty($vehicules)) : ?>
          <ul>
            <?php foreach ($vehicules as $vehicule) : ?>
              <li><strong>Marque :</strong> <?= htmlspecialchars($vehicule['nom_marque']) ?></li>
              <li><strong>Modèle :</strong> <?= htmlspecialchars($vehicule['modele']) ?></li>
              <li><strong>Couleur :</strong> <?= htmlspecialchars($vehicule['couleur']) ?></li>
              <li><strong>Énergie :</strong> <?= htmlspecialchars($vehicule['energie']) ?></li>
              <li><strong>Immatriculation :</strong> <?= htmlspecialchars($vehicule['immatriculation']) ?></li>
              <li>
                <form action="<?= route('deleteVehicule') ?>" method="post" style="display:inline;">
                  <input type="hidden" name="id_vehicule" value="<?= $vehicule['id_vehicule'] ?>">
                  <button type="submit" onclick="return confirm('Supprimer ce véhicule ?')">Supprimer</button>
                </form>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <h2>Aucun véhicule enregistré.</h2>
        <?php endif; ?>
        <h2>Ajouter un véhicule</h2>
        <form action=" <?= route('ajouterVehicule') ?>" method="post">

          <label for="nom_marque">Marque :</label>
          <input type="text" name="nom_marque" id="nom_marque" required>

          <label for="modele">Modèle :</label>
          <input type="text" id="modele" name="modele" require>

          <label for="immatriculation">Immatriculation :</label>
          <input type="text" id="immatriculation" name="immatriculation" require>

          <label for="couleur">Couleur :</label>
          <input type="text" id="couleur" name="couleur" require>

          <label for="energie">Énergie :</label>
          <select name="energie" required>
            <option value="essence">Essence</option>
            <option value="diesel">Diesel</option>
            <option value="electrique">Électrique</option>
            <option value="hybride">Hybride</option>
          </select>
          <button type="submit">Ajouter un vehicule</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Contenu de l'onglet Covoiturage -->
  <div id="covoiturage" class="tab-content">
    <div class="section">
      <h2>Covoiturage</h2>
      <form id="formCovoiturage" action="<?= route("ajouterCovoiturage") ?>" method="post">

        <label for="adresse_depart">Adresse de départ :</label>
        <input type="text" id="adresse_depart" name="adresse_depart" required>

        <label for="adresse_arrivee">Adresse d'arrivée :</label>
        <input type="text" id="adresse_arrivee" name="adresse_arrivee" required>

        <label for="date_depart">Date de départ :</label>
        <input type="datetime-local" id="date_depart" name="date_depart" required>

        <label for="date_arrivee">Date d'arrivée :</label>
        <input type="datetime-local" id="date_arrivee" name="date_arrivee" required>

        <label for="prix_personne">Prix par personne (crédits) :</label>
        <input type="number" id="prix_personne" name="prix_personne" step="0.01" required>

        <label for="places_disponibles">Places disponibles :</label>
        <input type="number" id="places_disponibles" name="places_disponibles" min="0" required>

        <label for="est_ecologique">Est écologique :</label>
        <input type="checkbox" id="est_ecologique" name="est_ecologique">

        <label for="animaux_autoriser">Animaux autorisés :</label>
        <input type="checkbox" id="animaux_autoriser" name="animaux_autoriser">

        <label for="fumeur">Fumeur :</label>
        <input type="checkbox" id="fumeur" name="fumeur">

        <div class="role-button">
          <label>Vous êtes :</label>
          <select name="role_utilisateur" required>
            <option value="conducteur">Conducteur</option>
            <option value="passager">Passager</option>
          </select><br>
        </div>
        <button type="submit">Enregistrer le covoiturage</button>
      </form>
      <?php if (!empty($_SESSION['success'])) : ?>
        <div class="message-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <?php if (!empty($_SESSION['error'])) : ?>
        <div class="message-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- contenu de l'onglet Gérer Covoiturages -->
  <div id="gestionCovoiturage" class="tab-content">
    <div class="section">
      <div id="displayCovoit" class="display-box">
        <h2>Mes Covoiturages Enregistrés</h2>
        <?php if (!empty($covoiturages)) : ?>
          <?php foreach ($covoiturages as $covoiturage) : ?>
            <ul>
              <li><strong>ID :</strong><?= htmlspecialchars($covoiturage['id_covoiturage']) ?></li>
              <li><strong>Rôle :</strong><?= htmlspecialchars($covoiturage['role_utilisateur']) ?></li>
              <li><strong>Départ :</strong><?= htmlspecialchars($covoiturage['adresse_depart']) ?></li>
              <li><strong>Arrivée :</strong><?= htmlspecialchars($covoiturage['adresse_arrivee']) ?></li>
              <li><strong>Date :</strong><?= date('d/m/Y H:i', strtotime($covoiturage['date_depart'])) ?></li>
              <li><strong>Détails :</strong> <a class="btn-details" href="/detailsCovoit?id=<?= $covoiturage['id_covoiturage'] ?>">🔍 Voir détails</a></li>
              <li>
                <?php if ($covoiturage['role_utilisateur'] === 'conducteur') : ?>
                  <form action=" <?= route('supprimeCovoiturage') ?>" method="post" style="display:inline;">
                    <input type="hidden" name="id_covoiturage" value="<?= $covoiturage['id_covoiturage'] ?>">
                    <button type="submit" onclick="return confirm('Supprimer définitivement ce covoiturage ?')">❌ Supprimer</button>
                  </form>
                <?php endif; ?>
              </li>
            </ul>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Aucun covoiturage enregistré pour le moment.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Contenu de l'onglet Avis -->
  <div id="avis" class="tab-content">
    <div class="section">
      <h2>Avis</h2>
      <h2 class="moyenne-note">Votre note :
        <?php if (!empty($moyenneUtilisateur)) : ?>
          <?php
          $fullStars = floor($moyenneUtilisateur);
          $halfStar = ($moyenneUtilisateur - $fullStars) >= 0.5;
          ?>
          <?php for ($i = 1; $i <= $fullStars; $i++) : ?>
            ⭐
          <?php endfor; ?>
          <?= $halfStar ? '⭐️' : '' ?>
          (<?= $moyenneUtilisateur ?>/5)
        <?php else : ?>
          Pas encore noté
        <?php endif; ?>
      </h2>
      <?php if (!empty($notesRecues)) : ?>
        <section class="notes-recues">
          <h2>Vos notes reçus</h2>
          <ul>
            <?php foreach ($notesRecues as $note) : ?>
              <li>
                <strong><?= htmlspecialchars($note['auteur']) ?></strong> a donné
                <strong><?= $note['note'] ?> ⭐</strong>
                le <?= date('d/m/Y', strtotime($note['date_notation'])) ?><br>
                <?php if (!empty($note['commentaire'])) : ?>
                  <em>"<?= htmlspecialchars($note['commentaire']) ?>"</em>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php else : ?>
        <p>Pas encore d’avis reçus.</p>
      <?php endif; ?>
      <h2>Vos avies envoyés</h2>
      <p><em>Les avis envoyés apparaîtront ici.</em></p>
      <?php /*
      <ul id="listeAvis">
        <?php
        $fichier = '../data/avis.json';
        if (file_exists($fichier)) {
          $avisListe = json_decode(file_get_contents($fichier), true);
          foreach ($avisListe as $avis) {
            if ($avis['idUser'] == $idUser) {
              echo '<li>';
              echo 'Vous avez mis une note de ';
              echo '<strong>' . htmlspecialchars($avis['note']) . '/5</strong> ';
              echo 'avec le commentaire : "' . htmlspecialchars($avis['commentaire']) . '"';
              echo ' <small>(' . htmlspecialchars($avis['date']) . ')</small>';
              echo '</li>';
            }
          }
        } else {
          echo '<li>Aucun avis pour le moment.</li>';
        }
        ?>
      </ul>
      */ ?>
    </div>
    <h2>Vos avies reçus</h2>
    <p><em>Les avis envoyés apparaîtront ici.</em></p>
    <?php /*
      <ul id="listeAvis">
        <?php
        $fichier = '../data/avis.json';
        if (file_exists($fichier)) {
          $avisListe = json_decode(file_get_contents($fichier), true);
          foreach ($avisListe as $avis) {
            if ($avis['idUser'] == $idUser) {
              echo '<li>';
              echo 'Vous avez mis une note de ';
              echo '<strong>' . htmlspecialchars($avis['note']) . '/5</strong> ';
              echo 'avec le commentaire : "' . htmlspecialchars($avis['commentaire']) . '"';
              echo ' <small>(' . htmlspecialchars($avis['date']) . ')</small>';
              echo '</li>';
            }
          }
        } else {
          echo '<li>Aucun avis pour le moment.</li>';
        }
        ?>
      </ul>
      */ ?>
  </div>
</div>
<!-- Inclusion des scripts JavaScript -->
<!-- script general pour le dashboard -->
<script src="/js/dashboard.js"></script>
<!-- Le script avis.js s'occupe de charger et d'afficher les avis depuis le fichier JSON -->
<script src="/js/avis.js"></script>