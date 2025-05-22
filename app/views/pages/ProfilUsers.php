<?php
$title = 'Mon profil';
?>
<div class="dashboard-container">
  <h1>Bienvenue, <?= htmlspecialchars($user['pseudo']) ?> !</h1>
  <div class="profil-actions">
    <button class="logout-button">
      <a href="?page=logout" class="logout-link">Se déconnecter</a>
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
    <button class="tab-link" data-tab="parametres">Paramètres</button>
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
          <img class="pp" src="/public/<?= htmlspecialchars($user['photo']) ?>" alt="photo de profil">
        </div>
        <ul>
          <li><strong>Pseudo :</strong><?= htmlspecialchars($user['pseudo']) ?></li>
          <li><strong>Nom :</strong><?= htmlspecialchars($user['nom']) ?></li>
          <li><strong>Prénom :</strong><?= htmlspecialchars($user['prenom'] ?? '') ?></li>
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

  <!-- contenue de l'onglet Paramètres -->
  <div id="parametres" class="tab-content">
    <div class="section">
      <div id="displayParametres" class="display-box">
        <!-- Affichage des paramètres enregistrés -->
        <h2>Vos paramètres</h2>
        <ul>
          <li><strong>Langue :</strong> <?= htmlspecialchars($langue) ?></li>
          <li><strong>Notifications :</strong> <?= htmlspecialchars($notifications) ?></li>
        </ul>
      </div>
      <h2>Modifier vos parametres</h2>
      <form id="formParametres" action="<?= route("parametres") ?>" method="post">
        <label for="langue">Langue :</label>
        <select id="langue" name="langue">
          <option value="fr">Français</option>
          <option value="en">Anglais</option>
          <option value="es">Espagnol</option>
        </select>

        <label for="notifications">Notifications :</label>
        <input type="checkbox" id="notifications" name="notifications">

        <button type="submit">Enregistrer les modifications</button>
      </form>
      <?php if (!empty($success)) : ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>
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
      <form id="formCovoiturage" action="#" method="post">
        <input type="hidden" name="id_utilisateur" value="<!-- insérer l'id de l'utilisateur -->">
        <input type="hidden" name="id_vehicule" value="<!-- insérer l'id du véhicule -->">

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
    </div>
  </div>

  <!-- contenu de l'onglet Gérer Covoiturages -->
  <div id="gestionCovoiturage" class="tab-content">
    <div class="section">
      <h2>Mes Covoiturages Enregistrés</h2>
      <p><em>Les covoiturages enregistrés et annulés apparaîtront ici.</em></p>
      <?php /*
      <table class="tableCovoiturages" id="tableCovoiturages">
        <thead>
          <tr>
            <th>Numéro du covoiturage</th>
            <th>Adresse départ</th>
            <th>Adresse arrivée</th>
            <th>Date départ</th>
            <th>Prix unitaire</th>
            <th>Places</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= htmlspecialchars($covoiturage['id_covoiturage']) ?></td>
            <td><?= htmlspecialchars($covoiturage['adresse_depart']) ?></td>
            <td><?= htmlspecialchars($covoiturage['adresse_arrivee']) ?></td>
            <td><?= htmlspecialchars($covoiturage['date_depart']) ?></td>
            <td><?= htmlspecialchars($covoiturage['prix_personne']) ?></td>
            <td><?= htmlspecialchars($covoiturage['places_disponibles']) ?></td>
            <!-- D'autres lignes ici -->
            <td><button class="cancel-covoiturage" data-id="<?= $covoiturage['id_covoiturage'] ?>">Annuler</button>td>
          </tr>
        </tbody>
      </table>
      <h2>Mes covoiturages annulés :</h2>
      <div id="displayGestionCovoiturage" class="display-box">
        <table class="tableCovoiturages" id="tableCovoiturages">
          <tbody>
            <thead>
              <tr>
                <th>Numéro du covoiturage</th>
                <th>Adresse départ</th>
                <th>Adresse arrivée</th>
                <th>Date départ</th>
                <th>Prix unitaire</th>
                <th>Places</th>
              </tr>
            </thead>
          <tbody>
            <tr>
              <td><?= htmlspecialchars($covoiturageAnnule['id_covoiturage']) ?></td>
              <td><?= htmlspecialchars($covoiturageAnnule['adresse_depart']) ?></td>
              <td><?= htmlspecialchars($covoiturageAnnule['adresse_arrivee']) ?></td>
              <td><?= htmlspecialchars($covoiturageAnnule['date_depart']) ?></td>
              <td><?= htmlspecialchars($covoiturageAnnule['prix_personne']) ?></td>
              <td><?= htmlspecialchars($covoiturageAnnule['places']) ?></td>
            </tr>
          </tbody>
        </table>
        </tbody>
      </div>
      */ ?>
    </div>
  </div>

  <!-- Contenu de l'onglet Avis -->
  <div id="avis" class="tab-content">
    <div class="section">
      <h2>Avis</h2>
      <section class="envoyer-avis">
        <h2>Laisser nous votre avis sur vos experiences</h2>
        <form method="POST" action="">
          <div class="form-group">
            <label for="note">Note (1 à 5) :</label>
            <select name="note" id="note" class="form-control" required>
              <option value="">-- Choisissez une note --</option>
              <option value="1">1 - Mauvais</option>
              <option value="2">2</option>
              <option value="3">3 - Moyen</option>
              <option value="4">4</option>
              <option value="5">5 - Excellent</option>
            </select>
          </div>
          <div class="form-group">
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" class="form-control" placeholder="Votre avis en quelques mots..." required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Envoyer l'avis</button>
        </form>
      </section>
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
  </div>
  <!-- Inclusion des scripts JavaScript -->
  <!-- script general pour le dashboard -->
  <script src="/js/dashboard.js"></script>
  <!-- Le script avis.js s'occupe de charger et d'afficher les avis depuis le fichier JSON -->
  <script src="/js/avis.js"></script>