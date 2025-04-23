<?php
$title = 'Mon profil';

// Fake user
$user = [
  'pseudo' => 'JohnDoe42',
  'email' => 'john.doe@example.com',
  'nom' => 'Doe',
  'prenom' => 'John'
];

// Fake véhicule
$vehicule = [
  'marque' => 'Peugeot',
  'modele' => '208',
  'immatriculation' => 'AB-123-CD',
  'couleur' => 'Rouge',
  'energie' => 'Essence'
];

// Fake covoiturage
$covoiturage = [
  'adresse_depart' => '123 Rue A',
  'adresse_arrivee' => '456 Rue B',
  'date_depart' => '2025-05-01',
  'prix' => '10.00',
  'places' => 3
];
?>
<div class="dashboard-container">
  <h1>bienvenue sur votre profil <!-- rajouter la variable usersession --></h1>

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
      <h2>Informations Personnelles</h2>
      <form id="formInfo" action="#" method="post" enctype="multipart/form-data">

        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom">

        <label for="email">Email :</label>
        <input type="email" id="email" name="email">

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse">

        <label for="credits">Vos crédits :</label>
        <input type="credits" id="credits" name="credits">

        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo">

        <button type="submit">Mettre à jour votre profile</button>
      </form>
      <div id="displayInfo" class="display-box">
        <!-- Affichage des informations personnelles enregistrées -->
        <h2>Vos données enregistrées</h2>
      </div>
    </div>
  </div>
  <!-- contenue de l'onglet Paramètres -->
  <div id="parametres" class="tab-content">
    <div class="section">
      <h2>Paramètres</h2>
      <form id="formParametres" action="#" method="post">
        <label for="langue">Langue :</label>
        <select id="langue" name="langue">
          <option value="fr">Français</option>
          <option value="en">Anglais</option>
          <option value="es">Espagnol</option>
        </select>

        <label for="notifications">Notifications :</label>
        <input type="checkbox" id="notifications" name="notifications">

        <button type="submit">Enregistrer les paramètres</button>
      </form>
      <div id="displayParametres" class="display-box">
        <!-- Affichage des paramètres enregistrés -->
      </div>
    </div>
  </div>

  <!-- Contenu de l'onglet Véhicule -->
  <div id="vehicule" class="tab-content">
    <div class="section">
      <h2>Véhicule</h2>
      <form id="formVehicule" action="#" method="post">
        <?php $listeMarque = [
          ['id_marque' => 1, 'nom_marque' => 'Peugeot'],
          ['id_marque' => 2, 'nom_marque' => 'Renault'],
          ['id_marque' => 3, 'nom_marque' => 'Citroën']
        ]; ?> <!-- // Récupération de la liste des marques depuis le modèle -->
        <label for="id_marque">Marque :</label>
        <select id="id_marque" name="id_marque" onchange="toggleMarqueAutre(this)">
          <?php foreach ($listeMarque as $marque): ?>
            <option value="<?= $marque['id_marque'] ?>"><?= htmlspecialchars($marque['nom_marque']) ?></option>
          <?php endforeach; ?>
          <option value="autre">Autre</option>
        </select>
        <div id="divAutreMarque" style="display: none;">
          <label for="nouvelle_marque">Nouvelle Marque :</label>
          <input type="text" id="nouvelle_marque" name="nouvelle_marque" placeholder="Entrez la marque">
        </div>

        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele">

        <label for="immatriculation">Immatriculation :</label>
        <input type="text" id="immatriculation" name="immatriculation">

        <label for="couleur">Couleur :</label>
        <input type="text" id="couleur" name="couleur">

        <label for="energie">Énergie utilisée :</label>
        <select id="energie" name="energie">
          <option value="essence">Essence</option>
          <option value="diesel">Diesel</option>
          <option value="electrique">Électrique</option>
          <option value="hybride">Hybride</option>
        </select>

        <button type="submit">Enregistrer</button>
      </form>
      <div id="displayVehicule" class="display-box">
        <!-- Affichage des informations véhicule enregistrées -->
      </div>
    </div>
  </div>

  <!-- Contenu de l'onglet Covoiturage -->
  <div id="covoiturage" class="tab-content">
    <div class="section">
      <h2>Covoiturage</h2>
      <form id="formCovoiturage" action="#" method="post">
        <!-- Ces champs cachés pourront être renseignés automatiquement par votre système -->
        <input type="hidden" name="id_utilisateur" value="<!-- insérer l'id de l'utilisateur -->">
        <input type="hidden" name="id_vehicule" value="<!-- insérer l'id du véhicule -->">

        <label for="adresse_depart">Adresse de départ :</label>
        <input type="text" id="adresse_depart" name="adresse_depart" required>

        <label for="adresse_arrivee">Adresse d'arrivée :</label>
        <input type="text" id="adresse_arrivee" name="adresse_arrivee" required>

        <label for="date_depart">Date de départ :</label>
        <input type="date" id="date_depart" name="date_depart" required>

        <label for="heure_depart">Heure de départ :</label>
        <input type="time" id="heure_depart" name="heure_depart">

        <label for="date_arrivee">Date d'arrivée :</label>
        <input type="date" id="date_arrivee" name="date_arrivee" required>

        <label for="heure_arrive">Heure d'arrivée :</label>
        <input type="time" id="heure_arrive" name="heure_arrive">

        <label for="prix_personne">Prix par personne (€) :</label>
        <input type="number" id="prix_personne" name="prix_personne" step="0.01" required>

        <label for="places_disponibles">Places disponibles :</label>
        <input type="number" id="places_disponibles" name="places_disponibles" min="0" required>

        <label for="est_ecologique">Est écologique :</label>
        <input type="checkbox" id="est_ecologique" name="est_ecologique">

        <label for="animaux_autoriser">Animaux autorisés :</label>
        <input type="checkbox" id="animaux_autoriser" name="animaux_autoriser">

        <label for="fumeur">Fumeur :</label>
        <input type="checkbox" id="fumeur" name="fumeur">
      </form>
      <button type="submit">Enregistrer le covoiturage</button>
      <div id="displayCovoiturage" class="display-box">
        <!-- Affichage des préférences covoiturage enregistrées -->
      </div>
    </div>
  </div>

  <!-- contenu de l'onglet Gérer Covoiturages -->
  <div id="gestionCovoiturage" class="tab-content">
    <div class="section">
      <h2>Mes Covoiturages Enregistrés</h2>
      <!-- Ici utiliser un tableau ou une liste pour afficher les covoiturages existants -->
      <table id="tableCovoiturages">
        <thead>
          <tr>
            <th>Adresse départ</th>
            <th>Adresse arrivée</th>
            <th>Date départ</th>
            <th>Prix</th>
            <th>Places</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple d'enregistrement, à remplacer par une boucle PHP -->
          <tr>
            <td>123 Rue A</td>
            <td>456 Rue B</td>
            <td>2025-05-01</td>
            <td>10.00 €</td>
            <td>3</td>
            <td><button class="cancel-covoiturage" data-id="1">Annuler</button></td>
          </tr>
          <!-- D'autres lignes ici -->
        </tbody>
      </table>
      <div id="displayGestionCovoiturage" class="display-box">
        <!-- Affichage des préférences covoiturage enregistrées -->
      </div>
    </div>
  </div>

  <!-- Contenu de l'onglet Avis -->
  <div id="avis" class="tab-content">
    <div class="section">
      <h2>Avis</h2>
      <!-- Conteneur dédié qui sera rempli par avis.js -->
      <ul id="listeAvis">
        <!-- Les avis seront injectés ici en JSON via NoSQL -->
      </ul>
    </div>
  </div>
  <!-- Inclusion des scripts JavaScript -->
  <!-- script general pour le dashboard -->
  <script src="/js/dashboard.js"></script>
  <!-- Le script avis.js s'occupe de charger et d'afficher les avis depuis le fichier JSON -->
  <script src="/js/avis.js"></script>
</div>